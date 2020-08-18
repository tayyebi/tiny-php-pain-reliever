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

        $RoadModel= $this->CallModel("Road");
        $Roads= $RoadModel->GetHome();

        $Data = [
            "Title" => _AppName . ' خانه',
            "Models" => [
                'Posts'=> $Posts,
                'Podcasts'=> $Podcasts,
                'Keywords' => $Keywords,
                'Roads'=> $Roads,
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
        $Description = 'Sariab RSS Feed.'; // TODO: Description

        header("Content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<rss version=\"2.0\">

<channel>
<title>$Title</title>
<link>$Link</link>
<description>$Description</description>";

        for ($i = 0 ; $i < count($Rows) ; $i++)
        {
            $item_title = htmlspecialchars( $Rows[$i]['Title']);
            $item_link = _Root . 'Home/Redirect/' . $Rows[$i]['Id'];
            $item_abstract = htmlspecialchars($Rows[$i]['Abstract']);
            $pub_date = $pubDate= date("D, d M Y H:i:s T", strtotime($Rows[$i]['Submit']));;

            echo "<item>
    <title>$item_title</title>
    <link>$item_link</link>
    <description>$item_abstract</description>
    <pubDate>$pub_date</pubDate>
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

    function RedirectGET($Id)
    {
        setcookie('CLIENT_VIEW',
        (isset($_COOKIE['CLIENT_VIEW']) ? $_COOKIE['CLIENT_VIEW'] : '') .
        '<' . $Id . '>'
        , time() + (86400 * 30), "/");

        $Model = $this->CallModel("Post");
        $Rows = $Model->GetItemByIdentifier([
            'Id'=> $Id
        ]);
        $this->RedirectResponse($Rows[0]['Canonical']);
    }

    function ViewGET($Id, $RoadId = null) {

        $Model = $this->CallModel("Post");
        $Rows = $Model->GetVerifiedItemByIdentifier([
            'Id'=> $Id
        ]);

        $Data = [
            "Title" => $Rows[0]['Title'],
            "RoadId" => $RoadId,
            "Model" => $Rows[0]
        ];
        
        $this->Render('view', $Data, true);
    }

    function RoadmapGET($Id) {

        $Model = $this->CallModel("Road");
        $Rows = $Model->GetItemByIdentifier([
            'Id'=> $Id
        ]);

        $RoadmapModel = $this->CallModel("Roadmap");
        $Roadmaps = $RoadmapModel->GetPostsByRoadId([
            'Id'=> $Id
        ]);

        $Data = [
            "Title" => $Rows[0]['Title'],
            "Road" => $Rows[0],
            "Posts" => $Roadmaps
        ];
        
        $this->Render('Roadmap', $Data);
    }

    function RulesGET()
    {
        // Read the file
        $filename = "docs/rules/public.txt";
        $publicrules = fopen($filename, "r") or die("فایل قوانین پیدا نشد!");
        $rules = str_repeat("       ",5) . "[ " . _Root . $filename . " ]" . str_repeat("\n",5);
        $rules .= fread($publicrules,filesize($filename));
        fclose($publicrules);

        // Render the view
        $Data = [
            'Title' => 'قوانین ساریاب',
            'Rules' => $rules
        ];

        $this->Render('Rules', $Data);
    }

    function SubmitGET()
    {
        $Data = [
            'Title' => 'ارسال محتوا برای ساریاب'
        ];

        $this->Render('Submit', $Data);
    }


    function SubmitPOST()
    {
        $Model = $this->CallModel('Post');
        $Model->SubmitPost([
            'Title' => $_POST['Title'],
            'Publisher' => $_POST['Publisher'],
            'Abstract' => $_POST['Abstract'],
            'Canonical' => $_POST['Canonical'],
        ]);

        $Data = [
            'Title' => 'ارسال محتوا برای ساریاب',
            'Message' => 'محتوا با موفقیت ثبت شد و در انتظار تایید تحریریه است! از شما ممنونیم.'
        ];
        $this->Render('Submit', $Data);
    }



}

