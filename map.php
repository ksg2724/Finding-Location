<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>Finding.Location</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    
      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="sep">
      <div class="container">
        <div class="row centered">
          <div class="col-md-8 col-md-offset-2">
          <div id="map" style="width:800px;height:500px;"></div>
          <script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=07a0f35fb7eb1dc28a7583f664360529"></script>
          <script>
              $.get("http://maps.googleapis.com/maps/api/geocode/json",
                    {"sensor": false, "language": "ko", "address": "<?php echo $_POST['location']; ?>"},
                    function(res) {
                  var currentLocation = res.results[0].geometry.location;
                  $.get("/getBathroom.php", function(result) {
                      result = JSON.parse(result);
                      // 마커를 표시할 위치와 title 객체 배열입니다
                      var positions = [];
                      for (var i = 0; i < result.length; i++) {
                          var temp = {
                              title: result[i].title,
                              latlng: new daum.maps.LatLng(parseFloat(result[i].lat), parseFloat(result[i].lng))
                          }
                          positions.push(temp);
                          
                      }
                      
                      var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
                    mapOption = { 
                        center: new daum.maps.LatLng(currentLocation.lat, currentLocation.lng), // 지도의 중심좌표
                        level: 3 // 지도의 확대 레벨
                    };

                var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

                // 마커 이미지의 이미지 주소입니다
                var imageSrc = "http://i1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 

                for (var i = 0; i < positions.length; i ++) {

                    // 마커 이미지의 이미지 크기 입니다
                    var imageSize = new daum.maps.Size(24, 35); 

                    // 마커 이미지를 생성합니다    
                    var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize); 

                    // 마커를 생성합니다
                    var marker = new daum.maps.Marker({
                        map: map, // 마커를 표시할 지도
                        position: positions[i].latlng, // 마커를 표시할 위치
                        title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
                        image : markerImage // 마커 이미지 
                    });
                }
                  });
              });
              </script>
              <form role="form" action="./index.php" method="post"> 
              <p><button class="btn btn-conf-2 btn-green">다시 자신의 위치 검색하기</button></p>
              </form>
          </div><!--/col-md-8-->
        </div>
      </div>
    </div><!--/sep-->

    <div id="green">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 centered">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active">
                  <h3>주의 하세요!</h3>
                  <h5><tgr>대한민국 외에 다른 국가 검색은 불가합니다.</tgr></h5>
                </div>
                  <div class="item">
                  <h3>주의 하세요!</h3>
                  <h5><tgr>아파트, 동사무소 등 너무 자세한 상세 주소는 입력 불가합니다.</tgr></h5>
                </div>
                <div class="item">
                  <h3>주의 하세요!</h3>
                  <h5><tgr>안산 외 다른 곳은 화장실 위치가 뜨지 않습니다.</tgr></h5>
                </div>
              </div>
            </div><!--/Carousel-->

          </div>
        </div><!--/row-->
      </div><!--/container-->
    </div><!--/green-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/retina-1.1.0.js"></script>
  </body>
</html>