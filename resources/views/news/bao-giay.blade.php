<html>
<head>
    <title>{{$newsContent->Title ?? '' }}</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">


    @include('expert.Css-dflip')

    <style>
        body {
            margin: 0;
        }
        h2{
            margin: 15px 0;
        }
        .clickable {
            cursor: pointer;
        }
        .df-container {
            height: 100% !important;
        }
    </style>
</head>
<body>
<div id="flipbookContainer"></div>


@include('expert.Js-dflip')

<script>

    var flipBook;

    jQuery(document).ready(function () {

        var pdf = '{{$newsContent->FilePath ??''}}';

        var options = {
            //moreControls: "pageMode,startPage,endPage,sound",
            backgroundColor: "gray", //gray
            ambientLightColor: "#fff"

        };

        flipBook = $("#flipbookContainer").flipBook(pdf, options);

        //NOTE:
        //Valid Control Names:
        //altPrev,pageNumber,altNext,outline,thumbnail,zoomIn,zoomOut,fullScreen,more
        //pageMode,startPage,endPage,download

        //We dont recommend putting pageNumber in moreControls, that doesn't make sense.
    });

</script>
<!-- {{$cdKey['news']['key']??''}}-->
</body>
</html>

