<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelCatatan;
use App\Services\Messages;
use App\Services\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ModelCatatanController extends Controller
{
    protected $responseService;
    protected $messagesService;
    public function __construct(Response $response, Messages $messages)
    {
        $this->responseService = $response;
        $this->messagesService = $messages;
    }

    /**
     * function untuk get Data Procurment type
     * @params proctype_code dan name untuk filter data
     * @author Zepri adi R
     */

    public function get()
    {
    // $data = DB::table('model_catatan')->select('*')->get();
    // return $data;
    //untuk menampilkan semua data catatan
        $perPage = request('size', 10);
        $page = request('page', 1);
        $model = ModelCatatan::when(request()->filled('description'), function($query) {
            $query->where('description', 'LIKE', '%'.request('description').'%');
        })->paginate($perPage, ['*'], 'page', $page);

        return $this->responseService->successJson($this->messagesService->successGetMessage, $model);
    }

     /**
     * function untuk get  Data Procurment type by id
     * @params id
     * @author Zepri adi R
     */

    public function find($id)
    {
        $model = ModelCatatan::where('id', $id)->first();

        if ($model) {
            return $this->responseService->successJson($this->messagesService->successGetMessage, $model);
        }
        return $this->responseService->notFoundErrorJson($this->messagesService->notFoundMessage);
    }

     /**
     * function untuk Insert  Data Procurment type
     * @params description dan name
     * @author Zepri adi R
     */
    public function store()
    {
        $post = request()->all();
        $validator = Validator::make($post, [
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseService->badRequestErrorJson('Bad Request', $validator->errors());
        }

        if ($result = ModelCatatan::create($post)) {
            return $this->responseService->successJson($this->messagesService->successCreateMessage, $result, 201);
        } else {
            return $this->responseService->internalServerErrorJson($this->messagesService->failedCreateMessage, null);
        }
    }

    public function update($id)
    {
        $post = request()->all();

        $validator = Validator::make($post, [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseService->badRequestErrorJson('Bad Request', $validator->errors());
        }

        $model = ModelCatatan::where('id', $id)->first();

        if ($model->update($post)) {
            return $this->responseService->successJson($this->messagesService->successUpdateMessage, $model, 201);
        } else {
            return $this->responseService->internalServerErrorJson($this->messagesService->failedCreateMessage, null);
        }
    }

    public function delete($id)
    {
        $model = ModelCatatan::where('id', $id)->first();
        if ($model) {
            if ($model->delete()) {
                return $this->responseService->successJson($this->messagesService->successDeleteMessage);
            } else {
                return $this->responseService->badRequestErrorJson($this->messagesService->failedDeleteMessage);
            }
        } else {
            return $this->responseService->notFoundError($this->messagesService->notFoundMessage);
        }
    }

    public function crawlWebsite() {
    // $url = 'https://cmlabs.co';
    $url = 'https://www.sequence.day/';
    // $url = 'https://www.bca.co.id/';
    $client = new Client();
    $response = $client->request('GET', $url);


    // Ambil isi dari response
    $html = $response->getBody()->getContents();

    // Buat objek Crawler
    $crawler = new Crawler($html);

    $footerElement = $crawler->filterXPath('//footer');


    $title = $crawler->filter('title')->text();
    $head = $crawler->filter('head')->text();
    $body = $crawler->filter('body')->text();
    if ($footerElement->count() > 0) {
        $footer = $crawler->filter('footer')->text();
    }else {
        $footer = '';
    }

    // return $data;
    $data = $title . $head . $body . $footer;

    // Simpan data ke dalam file HTML
    file_put_contents('bca.html', $data);
}
}
