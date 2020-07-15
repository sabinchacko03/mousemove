<html>
    <head>
        <style>
            .cursor {
                border-radius: 50%;
                background: red;
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
                <button id="live" class="btn btn-success">Play Live</button>
                <button id="record" class="btn btn-secondary">Record</button>
                <button id="play" class="btn btn-primary">Play</button>
                <button id="windowLink" class="btn btn-outline-info">Open Second Window</button>
                <button id="closeLink" class="btn btn-outline-danger">Close Second Window</button>
            </div>
        </div>        

        <div class="cursor"></div>
        <script>
            $(function() {
                var win2;
                var $replay = $('.cursor');
                $replay.html('<i class="fa fa-mouse-pointer fa-3x" aria-hidden="true"></i>');
                function openSecondaryWindow() {
                    return win2 = window.open('output.php', 'secondary', 'width=600,height=600, left=100');
                }
                $('#windowLink').click(function() {
                    openSecondaryWindow();
                    return false;
                });
                $('#closeLink').click(function() {
                    if(win2) win2.close();
                    return false;
                });
                
                var move = [];              
                $('#record').toggle(function() {        
                    move = [];       //to stop repeating the same patern
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-danger');
                    $(document).mousemove(function(e) {
                        move.push({
                            x: e.pageX,
                            y: e.pageY
                        });
                    });

                    win2.$('.cursor').css('background', 'green');
                    win2.$('.cursor').html('<i class="fa fa-mouse-pointer fa-3x" aria-hidden="true"></i>');
                                        
                }, function() {
                    $(document).off('mousemove');
                    $(this).removeClass('btn-danger');
                    $(this).addClass('btn-secondary');
                    $.post('save.php', { mousemove : JSON.stringify(move)}, function(response) {
                        // Log the response to the console
//                        console.log("Response: "+response);
                    });
                });
                
                $('#live').toggle(function() {
                    $(document).mousemove(function(e) {
                        $replay.css({
                            top: e.pageY - 50,
                            left: e.pageX - 60
                        });
                        if(win2){
                            win2.$('.cursor').css({
                                top: e.pageY - 50,
                                left: e.pageX - 50
                            });
                        }
                    });
                    win2.$('#playLiveSecond').removeClass('btn-light');
                    win2.$('#playLiveSecond').addClass('btn-success');
                }, function() {
                    $(document).off('mousemove');
                    win2.$('#playLiveSecond').removeClass('btn-success');
                    win2.$('#playLiveSecond').addClass('btn-light');
                });

                $('#play').click(function() {
                    var $replay = $('.cursor'),
                        pos, i = 0,
                        len = move.length,
                        t;

                    (function anim() {
                        pos = move[i];
                        $replay.css({
                            top: pos.y - 50,
                            left: pos.x - 60
                        });
                        if(win2){
                            win2.$('.cursor').css({
                                top: pos.y,
                                left: pos.x
                            });
                        }

                        i++;

                        if (i === len) {
                            clearTimeout(t);
                        } else {
                            t = setTimeout(anim, 10);
                        }
                    })()
                });
            });
        </script>
    </body>
</html>