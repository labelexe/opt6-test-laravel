<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        //проверяем авторизацию для данного раздела
        $this->middleware(['auth']);
    }

    /**
     * Список всех компании
     *
     * @return void
     */
    public function all(Request $request)
    {
        // $compnay_items = Company::all();
        // 
        return view('dashboard.pages.company.all', [
            "page_title" => "Список компаний",
            "data" => [
                "company" => [
                    "all" => [
                        // "items" => $compnay_items
                    ]
                ]
            ]
        ]);
    }

    public function getAddressCords($address)
    {
        $ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey=2b223cd4-aef9-45c6-bb16-cb5982a853f6&format=json&geocode=' . urlencode($address));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);

        $coordinates = $res['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
        $coordinates = explode(' ', $coordinates);

        //сортируем в обратном порядке
        rsort($coordinates);

        return $coordinates;
        // print_r($res);
    }

    /**
     * Просмотр компании
     *
     * @return void
     */
    public function show(Request $request, $id)
    {
        try {
            // dd($company_item_test);
            $company_item = Company::with('staff')->get()->find($id);

            $add_cords = $this->getAddressCords($company_item['address']);

            // 
            // dd($id);
            return view('dashboard.pages.company.show', [
                "page_title" => "Информация о компании",
                "data" => [
                    "company" => [
                        "item" =>  $company_item,
                        "item_ym_cords" => $add_cords
                    ]
                ]
            ]);
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }

    /**
     * Создание сотрудника [form]
     *
     * @return void
     */
    public function createForm()
    {
        return view('dashboard.pages.company.create', [
            "page_title" => "Создание компании",
            "data" => []
        ]);
    }

    /**
     * Сохрание логотипа компании
     */
    public function saveCompanyLogo(Request $request)
    {
        // dd($request);

        //
        if ($request->hasFile('logo_image')) {
            $image = $request->file('logo_image');
            //
            $hashedName = hash_file('md5', $image->path());
            //
            $newFilename = $hashedName . time() . '.' . $image->getClientOriginalExtension();

            //
            $disk = 'public';
            //генерируем уникальное название
            $fileName   = time();

            $file_path = '/company/images/logo/' . $newFilename;
            //сохранение
            $path = Storage::disk($disk)->putFileAs('', $image, $file_path);

            $path_url = Storage::disk($disk)->url($path);

            // dd($path_url);

            // $path = Storage::disk('local')->path($fileName);

            // dd($fileName);
            return $path_url;
        }
    }


    /**
     * Создание сотрудника [post]
     *
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            //Валидация 
            $validatedData = Validator::make($data, [
                'name' => ['required', 'unique:companies', 'max:255'],
                'email' => ['email'],
                'address' => ['required'],
                'logo_image' => ['required', "image", "dimensions:min_width=100,min_height=100"],
            ]);


            //иначе выдаем ошибку
            if ($validatedData->fails()) {
                return redirect()->route('company.create_form')
                    ->withErrors($validatedData)
                    ->withInput();
            } else {
                //Если прошел валидацию создаем
                $logo_src = $this->saveCompanyLogo($request);
                //
                $company = new Company();
                $company->name = $data['name'];
                $company->email = $data['email'];
                $company->address = $data['address'];
                $company->logo_src = $logo_src;


                //save
                $result = $company->save();

                //redirect
                return redirect()->route('company.all');
            }
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }


    public function updateForm(Request $request, $id)
    {
        $company_item = Company::with('staff')->get()->find($id);
        $add_cords = $this->getAddressCords($company_item['address']);
        // dd($company_item);

        return view('dashboard.pages.company.update', [
            "page_title" => "Обновление компании",
            "data" => [
                "company" => [
                    "item" =>  $company_item,
                    "item_ym_cords" => $add_cords
                ]

            ]
        ]);
    }


    /**
     * Обновление сотрудника
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            //Валидация 
            $validatedData = Validator::make($data, [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email'],
                'address' => ['required'],
                'logo_image' => ["image", "dimensions:min_width=100,min_height=100"],
            ]);

            //иначе выдаем ошибку
            if ($validatedData->fails()) {
                return redirect()->route('company.update_form', $id)
                    ->withErrors($validatedData)
                    ->withInput();
            } else {
                //Если прошел валидацию создаем
                $company = Company::with('staff')->get()->find($id);
                $company->name = $data['name'];
                $company->email = $data['email'];
                $company->address = $data['address'];
                //
                if ($request->hasFile('logo_image')) {
                    //Если прошел валидацию создаем
                    $logo_src = $this->saveCompanyLogo($request);
                    $company->logo_src = $logo_src;
                }

                // dd($company);
                //
                $result = $company->save();

                //redirect
                return redirect()->route('company.show', $id);

                // $company->logo_src = $logo_src;
            }
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }

    /**
     * Удаление компании
     *
     * @return void
     */
    public function delete(Request $request, $id)
    {
        try {
            // 
            $company_item = Company::find($id)->with('staff')->first();

            //staff delete
            $company_item->staff()->delete();

            //compnay delete
            $company_item->delete();

            return redirect()->route('company.all');
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }


    public function tablesShowData()
    {
        return datatables()->of(
            //queryies
            Company::query()
        )->make(true);
    }
}
