<?php

class HomeController extends Controller {

    function IndexGET($search_query = '') {

        $PostModel = $this->CallModel("Post");
        // TODO: From, to, limitation
        $Posts = $PostModel->GetHome([
            'q'=> $search_query
        ]);
        
        $PodcastModel = $this->CallModel("Podcast");
        $Podcasts = $PodcastModel->GetHome();

        $KeywordModel= $this->CallModel("Keyword");
        $Keywords= $KeywordModel->GetHome();

        $Data = [
            "Title" => _AppName . ' خانه',
            "Models" => [
                'Posts'=> $Posts,
                'Podcasts'=> $Podcasts,
                'Keywords' => $Keywords
            ]
        ];
        
        $this->Render('Index', $Data);
    }

    function RssGET($search_query = '') {
        $Model = $this->CallModel("Post");
        // TODO: From, to, limitation
        $Rows = $Model->GetHome([
            'q'=> $search_query
        ]);

        $Title = _AppName;
        $Link = _Root;
        $Description = ''; // TODO: Description

        header("Content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<rss version=\"2.0\">

<channel>
<title>$Title</title>
<link>$Link</link>
<description>$Description</description>";

        for ($i = 0 ; $i < count($Rows) ; $i++)
        {
            $item_title = $Rows[$i]['Title'];
            $item_link = _Root . 'Home/View/' . $Rows[$i]['Id'];
            $item_abstract = $Rows[$i]['Abstract'];


            echo "<item>
    <title>$item_title</title>
    <link>$item_link</link>
    <description>$item_abstract</description>
</item>
";
        }
        
echo '
</channel>

</rss>';
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