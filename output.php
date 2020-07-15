<html>
    <head>
        <style>
            .cursor {
                border-radius: 50%;
                background: green;
                width: 10px;
                height: 10px;
                position: fixed;
                top: 0;
                left: 0;
              }

              .click {
                border-radius: 50%;
                background: red;
                position: fixed;
                width: 20px;
                height: 20px;
              }
        </style>
        <script src="https://code.jquery.com/jquery-1.8.3.min.js" integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8=" crossorigin="anonymous"></script>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top:10px;">
                <button id="playLiveSecond" class="btn btn-light">Play Live</button>
                <button id="playRecordSecond" class="btn btn-light">Play Recording</button>
            </div>
        </div>        

        <div class="cursor"></div>
        <script>

            $(function() {
                var $cursor = $('.cursor');
                $cursor.html('<i class="fa fa-mouse-pointer fa-3x" aria-hidden="true"></i>');
                $("#playRecordSecond").click(function(){
                    $.get("fetch.php", function(data, status){
                        var mouseCord = JSON.parse(JSON.parse(data).coordinates);
                        var pos, i = 0,
                            len = mouseCord.length,
                            t;
                        (function anim() {
                            pos = mouseCord[i];
                            $cursor.css({
                                top: pos.y,
                                left: pos.x
                            });

                            i++;

                            if (i === len) {
                                clearTimeout(t);
                            } else {
                                t = setTimeout(anim, 10);
                            }
                        })()
                      });
                })                
            });
        </script>
        
    </body>
</html>