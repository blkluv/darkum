<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnnounceRequest;
use App\Http\Requests\UpdateAnnounceRequest;
use App\Models\Datas;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class AnnounceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $announces = DB::table('announces')->where('userId', Auth()->id())->get()->toArray();
    return view('pages.user.announces.index', compact('announces'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $typeL = Announce::selectRaw('typeL')->distinct()->get();
    $type = Announce::selectRaw('type')->distinct()->get();
    // dd($typeL, $type);
    return view('pages.user.announces.create', compact('typeL', 'type'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreAnnounceRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreAnnounceRequest $request)
  {
    $announce = Announce::create([
      'title' => $request->title,
      'description' => $request->description,
      'price' => $request->price,
      'nbRome' => $request->nbRome,
      'surface' => $request->surface,
      'city' => $request->city,
      'userId' => Auth()->id()
    ]);

    //announceimage
    if ($request->hasFile('image')) {
      foreach ($request->file('image') as $key => $image) {
        $ImageName = time() . $image->getClientOriginalName();
        $image->storeAs('images', $ImageName);
        Media::create([
          'url' => $ImageName,
          'idAnnounce' => $announce->id
        ]);
      }
    }

    return redirect()->route('announces.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Announce  $announce
   * @return \Illuminate\Http\Response
   */
  public function show(Announce $announce)
  {
    $data = null;
    $email = '';
    if (auth()->check()) {
      $email = Auth::user()->email;
    }
    $data = DB::table('datas')->where('userId', $announce->userId)->limit(1)->get()->toArray();
    $data = (!empty($data)) ? $data[0] : [];
    $announce_id = $announce->id;
    $comments = DB::table('comments')->where('AnnounceId', $announce_id)->get()->toArray();
    $names = [];
    foreach ($comments as $comment) {
      $name = User::find($comment->userId)->name;
      array_push($names, $name);
    }
    $medias = DB::table('medias')->where('idAnnounce', $announce_id)->get()->toArray();
    return view('pages.user.announces.show', compact('announce', 'data', 'email', 'announce_id', 'comments', 'names', 'medias'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Announce  $announce
   * @return \Illuminate\Http\Response
   */
  public function edit(Announce $announce)
  {
    return view('pages.user.announces.edit', compact('announce'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateAnnounceRequest  $request
   * @param  \App\Models\Announce  $announce
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateAnnounceRequest $request, Announce $announce)
  {
    $announce->update([
      'title' => $request->title,
      'description' => $request->description,
      'price' => $request->price,
      'nbRome' => $request->nbRome,
      'surface' => $request->surface,
      'city' => $request->city
    ]);
    return redirect()->route('announces.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Announce  $announce
   * @return \Illuminate\Http\Response
   */
  public function destroy(Announce $announce)
  {
    $announce->delete();
    return redirect()->route('announces.index');
  }

  //Get All Annconce BY TYPE

  public function allAnnonces(Request $req)
  {
    $villes = DB::table('announces')->distinct()->pluck('city');
    $path = $req->path();

    $announces = Announce::where("typeL", $path)->with('medias')->get();

    $nbAnnonces = $announces->count();

    $budgetMin =  floor(intval(Announce::where("typeL", $path)->min("price") / 100)) * 100;
    $surfaceMin =  floor(intval(Announce::where("typeL", $path)->min("surface") / 100)) * 100;
    $path = ucfirst($path);
    $pageInfo = [
      'nbAnnonces' => $nbAnnonces,
      'path' => $path,
      'villes' => $villes,
      'budgetMin' => $budgetMin,
      'surfaceMin' => $surfaceMin
    ];

    return view('pages.landing_page.' . $path, compact("announces", "pageInfo"));
  }

  public function filterSearch(Request $request)
  {
    // get the type of route (location | vente | vacance)
    $request->validate([
      'typeBien' => 'required|array|min:1',
      'typeBien.*' => 'required|string'
    ]);

    $path = $request->path();

    //get all ville to fill the region select 
    $villes = DB::table('announces')->distinct()->pluck('city');

    //type de bien selectionner par user (Appartement | Maison | Villas ...)
    $typesBien = $request->input('typeBien');

    // region rechercher  par user
    $region = $request->regionFilter;

    // le buget minimal et maximal selectionner par le user :
    $minBudget = $request->budgetMin;
    $maxBudget = $request->budgetMax;

    if ($maxBudget < $minBudget) {
      $swapBudget = $maxBudget;
      $maxBudget = $minBudget;
      $minBudget = $swapBudget;
    }

    // la surface minimal et maximal selectionner par le user :
    $minSurface = $request->SurfaceMin;
    $maxSurface = $request->surfaceMax;


    // nombre de chambre choisie par user
    $nbChambre = $request->input('nbChambre');

    //get caracteristique choisie par user :
    $caracteristiques = $request->input('caracteristique');


    // get all annonces by type of route (location | vente | vacance)
    $announces = Announce::where("typeL", $path);

    //get  annonces filtred by type de bien (Appartement | Maison | Villas ...):

    if (!empty($typesBien)) {
      $announces = $announces->wherein("type", $typesBien);

      // get les annonces filtrer by ville selectionner par user:
      if (!empty($region)) {
        $announces = $announces->where("city", "like", "%" . $region . "%");
      }

      // get les annonces filtrer by budget selectionner par user:
      if (!empty($minBudget) || !empty($maxBudget)) {
        $minBudget = $minBudget == null ? 0 : $minBudget;
        $maxBudget = $maxBudget == null ? Announce::max("price") : $maxBudget;
        $announces = $announces->whereBetween("price", [$minBudget, $maxBudget])->orderBy('price');
      }

      // get les annonces filtrer by surface selectionner par user:
      if (!empty($minSurface) || !empty($maxSurface)) {
        $minSurface = $minSurface == null ? 0 : $minSurface;
        $maxSurface = $maxSurface == null ? Announce::max("surface") : $maxSurface;
        $announces = $announces->whereBetween("price", [$minSurface, $maxSurface])->orderBy('surface');
      }

      // get annonce whit nbChambre 

      if (!empty($nbChambre)) {
        //pour gerer le cas de choisir +6
        $index = array_search(6, $nbChambre);
        if ($index !== false) {
          unset($nbChambre[$index]);
          $announces = $announces->wherein("nbRome", $nbChambre)->orwhere("nbRome", ">=", 6);
          // rajouter la valeur au tableau pour reselectionner sur le view (si le user choisie +6)
          array_push($nbChambre, "+6");
        } else $announces = $announces->wherein("nbRome", $nbChambre);
      }


      if (!empty($caracteristiques)) {
        $announces = $announces->where(function ($query) use ($caracteristiques) {
          foreach ($caracteristiques as $caracteristique) {
            $query->orWhere('description', 'like', '%' . $caracteristique . '%');
          }
        });
      }
      // calculer le nombre des annonces pour le afficher
      $nbAnnonces = $announces->count();

      // pour remplir  select de budget : 
      $budgetMin =  floor(intval(Announce::where("typeL", $path)->min("price") / 100)) * 100;

      // pour remplir  select de surface : 
      $surfaceMin =  floor(intval(Announce::where("typeL", $path)->min("surface") / 100)) * 100;

      //get les annonces avec leur photo.
      $announces = $announces->with('medias')->get();
      
    }
    $path = ucfirst($path);
    $pageInfo = [
      'nbAnnonces' => $nbAnnonces,
      'path' => $path,
      'villes' => $villes,
      'budgetMin' => $budgetMin,
      'surfaceMin' => $surfaceMin
    ];

    $old_choices = [
      'caracteristiques' => $caracteristiques,
      'nbChambre' => $nbChambre,
      'minSurface' => $minSurface,
      'maxSurface' => $maxSurface,
      'minBudget' => $minBudget,
      'maxBudget' => $maxBudget,
      'typesBien' => $typesBien,
      'region' => $region
    ];

    return view("pages.landing_page." . strtolower($path), compact("announces", "pageInfo", "old_choices"));
    // return view("pages.landing_page.location", compact("announces", "nbAnnonces", 'path', "villes", "region", 'budgetMin', "surfaceMin"));
  }

  public function filterIndex(Request $request)
  {
    $path = $request->filter;
    $typeBien = $request->typeBien;
    $ville = $request->searchVille;

    $announces = Announce::where("typeL", $path);
    if ($typeBien == "all"){
      if(!empty($ville)){
        $announces = $announces->where("city", $ville);
      }
    }
    else
      $announces = $announces->where("city", $ville)->where("type", $typeBien);

    // calculer le nombre des annonces pour le afficher
    $nbAnnonces = $announces->count();

    // pour remplir  select de budget : 
    $budgetMin =  floor(intval(Announce::where("typeL", $path)->min("price") / 100)) * 100;

    // pour remplir  select de surface : 
    $surfaceMin =  floor(intval(Announce::where("typeL", $path)->min("surface") / 100)) * 100;

    //get les annonces avec leur photo.
    $announces = $announces->with('medias')->get();

    //get all ville to fill the region select 
    $villes = DB::table('announces')->distinct()->pluck('city');

    $path = ucfirst($path);
    $pageInfo = [
      'nbAnnonces' => $nbAnnonces,
      'path' => $path,
      'villes' => $villes,
      'budgetMin' => $budgetMin,
      'surfaceMin' => $surfaceMin
    ];

    $old_choices = [

      'region' => $ville
    ];
  

    return redirect()->route(strtolower($path), compact("announces", "pageInfo", "old_choices", "ville", "typeBien"));
  }
}
