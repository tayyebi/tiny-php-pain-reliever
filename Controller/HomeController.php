<?php

class HomeController extends Controller {

    function IndexGET($search_query = '') {

        $PostModel = $this->CallModel("Post");
        // TODO: From, to, limitation
        $Posts = $PostModel->GetHome([
            'q'=> $search_query
        ]);
        
        // $PodcastModel =
        // $Podcast = 

        // $KeywordModel=
        // $Keywords=

        $Data = [
            "Title" => _AppName . ' خانه',
            "Models" => [
                'Posts'=> $Posts,
                // 'Podcast'=> $Podcast,
                // 'Keywords' => $Keywords
            ]
        ];
        
        $this->Render('Index', $Data);
    }



    function ThankYouGET($search_query = '') {

        $Model = $this->CallModel("Support");
        // TODO: From, to, limitation
        $Supports = $Model->GetAll();

        $Data = [
            "Title" => _AppName . ' قدر دانی',
            "Model" => $Supports
        ];
        
        $this->Render('thankyou', $Data);
    }



    function PositionsGET($search_query = '') {

        $Model = $this->CallModel("Position");
        $Supports = $Model->GetActive();

        $Data = [
            "Title" => _AppName . ' موقعیت‌های همکاری',
            "Model" => $Supports
        ];
        
        $this->Render('positions', $Data);
    }

}