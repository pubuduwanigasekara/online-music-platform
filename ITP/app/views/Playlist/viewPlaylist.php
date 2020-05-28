<?php

$PM = new Playlist_model();
$PD = $PM->getPlaylist( $this->data['playlistID'] );
$playlistSongs = $PM->getPlaylistSongs( $this->data['playlistID'] );
$PlaylistDetails = mysqli_fetch_row($PD);

$ShareBtnColor = ($PlaylistDetails[6] == 1 ) ? "btn-success" : "btn-dark";
$ShareBtnText = ( $PlaylistDetails[6] == 1 ) ? "Make Private" : "Share Public";
$ShareBtnIcon = ( $PlaylistDetails[6] == 1 ) ? "" : "<i class='fa fa-share'></i>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="<?=PR?>/css/bootstrap.min.css" >
   <link href="<?=PR?>/css/simple-sidebar.css" rel="stylesheet">
   <link rel="stylesheet" href="<?=PR?>/css/main.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?=PR?>/css/playlist.css">

    
    <title>Document</title>
</head>
<body >
 
    <div class="d-flex" id="wrapper">

        
         <!-- Sidebar -->
         <?php    
            $navbar = new View();
            $navbar->assign('Selected', 'Playlist' );
            $navbar->render('NavBar/index');
        ?>
        <!-- /#sidebar-wrapper -->
    
        <!-- Page Content -->
        <div id="page-content-wrapper">
    
          <div class="container-fluid">
            
              <div class="row card-container" style="padding: 0px !important;">
                <div class="col-md-12" id="song-banner" >
                  <div class="row" >
                    <div class="col-md-6 offset-md-3 mt-5">
                        <div class="p-1 bg-dark rounded rounded-pill  mb-1">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <button id="button-addon2" type="submit" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
                              </div>
                              <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon2" class="form-control border-0 bg-dark">
                            </div>
                          </div>
                    </div>
                  </div></div>
                      <div class="col-12 song-container" >
                              <div class="row" style="padding: 0px !important" >
                            <div class="col-md-3  col-sm-6  col-12 song-image-container " style=" background-image: url(<?=PR?><?=$PlaylistDetails[3]?>);" >
                           
                            </div>
                            <div class="col-md-9 col-sm-6 col-12 pl-4"  >
                              <h4 class="descrption card-subtitle text-muted mt-2"><b>PLAYLIST</b> 
                              <!-------------------------------------------------------------------------------->
                              <a href="<?=PR?>/Playlist/share/<?=$PlaylistDetails[0]?>/<?=$PlaylistDetails[6]?>" class="btn btn-sm <?=$ShareBtnColor?>" style="font-size: 0.7em;"><b><?=$ShareBtnIcon?>  <?=$ShareBtnText?><b></a></h4>
                              
                              <h2 class="song-name-text"  ><?=$PlaylistDetails[1]?> 
                               <h6 class="descrption text-muted mt-2">Contrary to popular belief, Lorem Ipsum is not simply random text.
                                  It has roots in a piece of classical Latin literature from 45 BC,
                                   making it over 2000 years old.</h6>
                                   <button style="padding: 5px 20px; font-size: 1em; font-style: normal !important" type="button"  class="btn btn-success btn-lg">
                                      <b><i class="fa fa-play-circle "></i> Play</b></button>
                                      <button style="padding: 5px 10px; font-size: 1em; font-style: normal !important" type="button"  class="btn btn-primary btn-lg">
                                          <b><i class="fa fa-edit fa-lg "></i></b></button>
                                      
                              </div></div>
                              </div>
                            
                 
                    </div>
                    <!------------------------------------------------------------------------------------------------------>
                    <div class="row card-container" >
                        <div class="col-md-12 mt-4 playlist-table-wrapper"  >
                            <table class="table ">
                                <thead>
                                  <tr>
                                    <th scope="col" width="30%" >TITLE</th>
                                    <th scope="col" width="30%" >ARTIST</th>
                                    <th scope="col" width="20%">GENRE</th>
                                    <th scope="col" width="10%">TIME</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <?php  while($row = $playlistSongs->fetch_assoc()) {     ?>
                                <tr>
                                    <th scope="row"><?=$row['SongName']?></th>
                                    <td><a href="<?=PR?>/Artist/View/<?=$row['ArtistID']?>"> <?=$row['FirstName']?> <?=$row['LastName']?> </a></td>
                                    <td><?=$row['Genre']?></td>
                                    <td><?=$row['Duration']?></td>
                                  </tr>
                                 <?php  }     ?>
                              </tbody>
                            </table>
                    </div>
                    </div>
             
             
              
          
        </div>
          </div>
          </div>
     
          <script src="<?=PR?>/js/Vibrant.js" ></script>
          <script src="https://unpkg.com/wavesurfer.js"></script>
        <script>
         var color = "red"
        var img = document.createElement('img');
          img.setAttribute('src', '<?=PR?><?=$PlaylistDetails[3]?>')
          img.addEventListener('load', function() {
   
            var vibrant = new Vibrant(img);
      var swatches = vibrant.swatches()
    var rgb = swatches["DarkVibrant"].getRgb();
     window.color =  "rgba( "+rgb[0] +", " + rgb[1]+", " + rgb[2] + ", " + ".3 )" ;
       
     document.getElementById("page-content-wrapper").style.background = "linear-gradient(135deg, " + color + 
     " 0%, rgba(0,0,0,0) 110%)";

});
       </script>
    
      
</body>
</html>