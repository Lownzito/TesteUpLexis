<?php

namespace App\Services;

use App\Http\Resources\CarResource;
use App\Models\Carro;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class ScrapeService{

    /**
     * Serviço responsável por executar a raspagem de dados e salvar no banco de dados
     */

    public function scrape($termo = null)
    {
        $buildUrl = 'https://www.questmultimarcas.com.br/estoque?termo='.$termo;

        $content = file_get_contents($buildUrl);
        
        if(!preg_match_all('/<div class="col-12 col-xxl d-xxl-flex justify-content-xxl-end d-block">(.*?)<\/div>/s', $content, $matches))
        {
            return response()->json([
                'success' => false,
                'error' => 'nenhum resultado encontrado'
            ], 404,[], JSON_PRETTY_PRINT);
        }

        //array para salvar todos os links
        $links = [];
        foreach($matches[1] as $href)
        {
            preg_match('/href="(.*?)"/' ,$href, $link);
            $links[] = $link[1];
        }
        
        $carCollection = [];
        foreach($links as $link)
        {
            //array que irá salvar todos os dados do carro para depois ser inserido no banco
            $carData = [
                'user_id' => Auth::user()->id,
                'nome_veiculo' => '',
                'link' => '',
                'ano'  => '',
                'combustivel' => '',
                'preco' => '',
                'portas'  => '',
                'quilometragem' => '',
                'cambio'    => '',
                'cor'   => '',
                'photo_url' => ''
            ];
            $page = file_get_contents($link);
            $carData['link'] = $link;
            
            preg_match('/<strong><span class="fs-6 price-solo">R\$<\/span>(.*?)<\/strong>/', $page, $valor);
            $carData['preco'] = trim($valor[1]);

            //extrai o nome do veículo e trata a string para que não venha 'em São Paulo - Quest multimarcas'
            preg_match('/<title>(.*?)<\/title/s', $page, $title);
            $nome_veiculo = explode('em', $title[1]);
            $carData['nome_veiculo'] = $nome_veiculo[0];

            //extrai o número de portas do título da página
            preg_match('/[0-9]{1} portas/',$title[1], $numeroPortas);
            $carData['portas'] = $numeroPortas[0];

            if(preg_match('/<div class="main-img">(.*?)<\/div>/s', $page, $imgHtml)){
                preg_match('/src="(.*?)"/', $imgHtml[1], $photoUrl);
                $carData['photo_url'] = $photoUrl[1];
            }
            

            //extrai o tipo de combustível do veículo
            preg_match('/Diesel|Elétrico|Flex|Gasolina e Elétrico|Gasolina/', $title[1], $combustivel);
            $carData['combustivel'] = $combustivel[0];

            preg_match_all('/<div class="col-6 col-md-4 d-flex align-items-stretch tech-specs-item">(.*?)<\/div>/s', $page, $data);
           
            foreach($data[1] as $html)
            {
                //remover todas as tags html
                $lookinto = strip_tags($html);

                if(preg_match('/Automático|Manual/', $lookinto, $match)){
                    $carData['cambio'] = $match[0];
                    continue;
                }
                elseif(preg_match('/[0-9]{4}\/[0-9]{4}/', $lookinto, $match))
                {
                    $carData['ano'] = $match[0];
                    continue;
                }
                elseif(preg_match('/(.*?).[0-9]{3} km/', $lookinto, $match))
                {
                    $carData['quilometragem'] = trim($match[0]);
                    continue;
                }
                /**
                 * Para pular a tag de combustível se ela houver na ficha técnica 
                 */
                elseif(preg_match('/Flex \(Álcool\)|\(Gasolina\)|Diesel|Gasolina e Elétrico|Gasolina/', $lookinto))
                {
                    continue;
                }
                //se nenhum dos casos acontecer, irá retornar a cor
                else{
                    $carData['cor'] = trim($lookinto);
                }
            }
            $carCollection[] = Carro::create($carData);
        }
        
        return response()->json([
            'success' => true,
            'cars'    => CarResource::collection($carCollection)
        ], 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }
}