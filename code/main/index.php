<!DOCTYPE html>
<?php

  require_once("php/DBConn.php");
  require_once("php/define.php");
  $dbconn = new dbconn($db_dbname);


  date_default_timezone_set('Asia/Taipei');
  $in_date = date('Y-m-d', time());
  $ch_date = explode("-", $in_date);
  $ch_date[0] = $ch_date[0]-1911;
  $date = $ch_date[0]."".$ch_date[1]."".$ch_date[2];


?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

  </head>

  <body class="nav-sm">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="#"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a href="fish.php"><i class="fa fa-edit"></i> 漁產品 </a>
                  </li>
                  <li><a href="agricultural.php"><i class="fa fa-desktop"></i> 農業 </a>
                  </li>
                  <li><a href="rice.php"><i class="fa fa-table"></i> 農糧米 </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle"> 
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <!-- tiles row-->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>今日省最多食材 <small>與上周平均價格比較</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="row tile_count">

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> 草蝦養</span></br>
                    <img src="img1_1.jpg" height="80" width="100%"/>
                    <div class="count green">
                      <?php
                      //草蝦養
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=1&$skip=0&MarketName=%E5%8F%B0%E5%8C%97&TypeName=%E8%8D%89%E8%9D%A6%E9%A4%8A';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);
                      if(!empty($json))
                        echo $json[0]["平均價"]; 
                      else
                        echo "休市";         
                      ?>
                      <span>元/條</span> 
                    </div>
                    <span class="count_bottom "><i class="green"><i class="fa fa-sort-desc"></i>
                    <?php
                      //草蝦養 
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=7&$skip=1&MarketName=%E5%8F%B0%E5%8C%97&TypeName=%E8%8D%89%E8%9D%A6%E9%A4%8A';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);

                      $avg = 0;
                      foreach ($json as $row) {
                        $avg += (float) $row["平均價"];

                      }
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)(($json[0]["平均價"] - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a1_1" data-toggle="modal" data-target=".a1_1" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b1_1" data-toggle="modal" data-target=".b1_1" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a1_1" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">草蝦養 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart1_1" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b1_1" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=炸蝦條" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">炸蝦條</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab3_1_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab3_1_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab3_1_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab3_1_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b1_1.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>吳草蝦12條、低筋麵粉2杯、蛋黃2個、冰水(0℃)1 1/2杯。</p>
                                        <p>炸油 (沙拉油3：白麻油1) 。</p>
                                        <h4>作法：</h4>
                                        <ul >
                                          <li>洗淨，去項殼(留尾殼)抽泥腸，腹部用刀割4－5刀使白筋斷裂，並用手將蝦體壓至平直備用。</li>
                                          <li>蛋黃打散，加入冰水攪勻後加入1杯麵粉以筷子畫十字型稍拌即可。</li>
                                          <li>炸油燒熱，將蝦先沾乾麵粉，再沾蛋黃糊入鍋炸黃即可。</li>
                                        </ul>
                                        <h4>營養成分</h4>
                                        <p>熱量1780卡、蛋白質75克、脂肪111克、醣類119克。</p>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab3_1_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>草蝦</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">又稱斑節對蝦，分布於印度洋-太平洋海域，東至日本海、西至非洲西海岸和阿拉伯半島、南至澳大利亞，是一種十分常見的養殖蝦。</p>
                                          <p class="excerpt">該蝦生長快，適應性強，食性雜，巳可耐受較長時間的干露，故易幹活運銷。成熟蝦一般體長22.5～32厘米，體重137～211克，是深受消費者歡迎的蝦類。營養價值與其他主要蝦類相近。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab3_1_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"炸蝦條");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> 白鯧</span></br>
                    <img src="img1_2.jpg" height="80" width="100%"/>
                    <div class="count green">
                      <?php
                      //白鯧
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=1&$skip=0&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E7%99%BD%E9%AF%A7';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);
                      if(!empty($json))
                        echo $json[0]["平均價"]; 
                      else
                        echo "休市";         
                      ?>
                      <span>元/條</span> 
                    </div>
                    <span class="count_bottom "><i class="green"><i class="fa fa-sort-desc"></i>
                    <?php
                      //草蝦養
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=7&$skip=1&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E7%99%BD%E9%AF%A7';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);

                      $avg = 0;
                      foreach ($json as $row) {
                        $avg += (float) $row["平均價"];

                      }
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)(($json[0]["平均價"] - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a1_2" data-toggle="modal" data-target=".a1_2" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b1_2" data-toggle="modal" data-target=".b1_2" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a1_2" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">白鯧 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart1_2" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b1_2" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=五味白鯧" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">五味白鯧</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1_2_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab1_2_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab1_2_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab1_2_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b1_2.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>白鯧1尾。</p>
                                        <p>蒜頭(切碎)1湯匙、蔥(切珠)1湯匙、薑(切末)1湯匙、辣椒(切珠)1湯匙</p>
                                        <h4>調味料：</h4>
                                        <p>醬油1湯匙、 糖1/2湯匙、烏醋1湯匙。</p>
                                        <h4>作法：</h4>
                                        <ul >
                                          <li>白鯧去鱗、鰓、內臟洗淨，油沸炸熟撈起。剩2湯匙油將2料爆香淋在魚身即可。</li>
                                        </ul>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1_2_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>白鯧</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">台灣水產史料記載兩位台籍日本兵吳振輝及郭啟彰於1946年從新加坡返台時，引進莫三比克口孵非鯽，因此稱作吳郭魚，又稱南洋鯽仔。</p>
                                          <p class="excerpt"> 引進台灣後大量養殖，其肉質鮮嫩，小刺少，雖然微有土腥味，但因養殖容易、價格便宜等因素，成為大眾食物蛋白質的重要來源。唯目前台灣人工養殖的口孵非鯽與非鯽大多是後來由台灣水產試驗所及台灣水產業者育成的雜交種。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>蒜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">蒜是多年生宿根草本植物，大蒜的品種多，按照鱗莖外皮的色澤可分為紫皮蒜與白皮蒜兩種。分布在華北、西北與東北等地，耐寒力弱，多在春季播種，成熟期晚；白皮蒜有大瓣和小瓣兩種，辛辣味較淡，比紫皮蒜耐寒，多秋季播種，成熟期略早。</p>
                                          <p class="excerpt">大蒜中的有機硫化合物能有效抑制大腸癌細胞，抗癌成分能讓癌細胞週期停滯，直到死亡。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>蔥</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">別名青蔥、大蔥，常作為一種很普遍的香料調味品或蔬菜食用，在東方烹調中佔有重要的角色。</p>
                                          <p class="excerpt">蔥有較強的殺菌作用，特別是對痢疾桿菌和皮膚真菌抑制作用比較明顯。本品亦能刺激汗腺，有發汗作用，並能促進消化液分泌，有健胃作用。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>薑</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">原產於東南亞熱帶地區植物，開有黃綠色花並有刺激性香味的根莖。根莖鮮品或乾品可以作為調味品。</p>
                                          <p class="excerpt">可對抗發炎、清腸、減輕痙攣和抽筋，及刺激血液循環。是一種強的抗氧化劑，對於疼痛和傷口是一種有效的殺菌劑，可保護肝臟和胃，對治療腸道疾病、血液循環問題、關節炎、發燒、頭痛、熱潮紅、消化不良、孕婦晨吐、動暈症、肌肉疼痛、噁心和嘔吐很有幫助。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>辣椒</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 辣椒原產於中南美洲熱帶地區，早於公元前7500年已用作烹調食品。能幫助消化作用、促進循環和停止潰瘍出血，可做為其它藥用植物的催化劑。</p>
                                          <p class="excerpt"> 對於心臟、腎臟、肺臟、胰臟、脾臟以及胃部有益，有助於關節炎和風濕症，幫助避免感冒、靜脈竇感染以及喉嚨痛，局部使用可減輕疼痛，與山梗菜屬的植物並用，可以改善神經過敏。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1_2_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"五味白鯧");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->
              

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> 竹筍</span></br>
                    <img src="img1_3.jpg" height="80" width="100%"/>
                    
                    <div class="count green">
                      13<span> 元/條</span> 
                    </div>
                    <span class="count_bottom "><i class="green"><i class="fa fa-sort-desc"></i>
                    <?php
                      $avg = 40 + 25 + 35 + 12 + 24 + 20 + 10;
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)((13 - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a1_3" data-toggle="modal" data-target=".a1_3" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b1_3" data-toggle="modal" data-target=".b1_3" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a1_3" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">竹筍 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart1_3" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b1_3" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=香菇肉羹" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">香菇肉羹</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1_3_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab1_3_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab1_3_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab1_3_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b1_3.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>鮮香菇4朵、瘦肉3兩、金針菇5兩。</p>
                                        <p>筍1小枝、胡蘿蔔少許、蛋1個。</p>
                                        <p>味精、鹽各1小匙、烏醋、太白粉各1小匙。</p>
                                        <p>香油1茶匙、沙拉油2湯匙、蔥頭穌1大匙。</p>
                                        <h4>調味料：</h4>
                                        <p>料理米酒、精鹽、芥末醬1茶匙、蕃茄醬2大匙、沙拉醬3大匙</p>
                                        <h4>作法：</h4>
                                        <ul >
                                          <li>將筍、鮮香菇、瘦肉、胡蘿蔔各切絲，並將蛋打散待用。</li>
                                          <li>沙拉油於鍋中燒熟，放入鮮香菇、肉絲炒香之後，加水1湯匙及筍絲、胡蘿蔔絲、金針菇、蔥頭穌、鹽、味精煮熟。</li>
                                          <li>調入太白粉勾芡，烏醋、蛋液、香油、胡椒粉、芹菜末，即可起鍋上桌。</li>
                                        </ul>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1_3_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>香菇</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 主要產地在台灣台中新社、南投埔里、新竹尖石、五峰，產季為冬菇12～3月、夏菇4～6月。</p>
                                          <p class="excerpt"> 吃香菇可以預防骨質疏鬆症，因為太陽曬過的香菇富含可以幫助鈣質吸收的維生素D2。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>瘦肉</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 瘦肉有三個部位；小里肌肉、臀尖肉、坐臀肉，其中小里肌肉是脊骨下面一條與大排骨相連的瘦肉。肉中無筋，是豬肉中最嫩的一部分。水分含量多，脂肪含量低，肌肉纖維細小，炸、、炒、爆等烹調方法都適合。</p>
                                          <p class="excerpt"> 臀尖肉位於臀部的上面，都是瘦肉，肉質鮮嫩，烹調時可用來代替裡脊肉。</p>
                                      <p class="excerpt">  坐臀肉位於后腿上方，臀尖肉下方。全為瘦肉，但肉質較老，纖維較長，一般多在做白切肉或回鍋肉時用。</p>
                                    </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>金針菇</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 金針菇分布世界各地，屬於木棲腐生野菇之一種，人工種植亦使用此方法。另外，該種菌類生長於春天，秋天與冬天的中高海拔林區，數天生，肉質軟，亦可加工成為藥材。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>筍</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 是指幼竹莖稈的幼嫩生長部分。還沒有完全從地底下長出來時，以及剛剛出土仍未木質化的部分可作為蔬菜食用。</p>
                                          <p class="excerpt"> 筍乾燒，以筍飯等的形式食用。烹調時候需要去掉澀味，筍亦可以炒食。筍乾味道鮮美，可燒肉或加水煮湯。現在，也有將筍乾再精細加工，做成小包裝，成為休閒食品。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>胡蘿蔔</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 原產於中亞西亞一帶，元代末傳入中國。胡蘿蔔是一種難得的果、蔬、藥兼用品。</p>
                                          <p class="excerpt"> 胡蘿蔔含有大量的胡蘿蔔素，胡蘿蔔素在人體內可以很快轉化為維生素A，對人體，特別是對老年人能產生明目養神，防治呼吸道感染，調節新陳代謝，增強抵抗力等作用。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>  
                                <div role="tabpanel" class="tab-pane fade" id="tab1_3_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"吳郭戲水");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> 白菜</span></br>
                    <img src="img1_4.jpg" height="80" width="100%"/>
                    
                    <div class="count green">
                      13<span> 元/公斤</span> 
                    </div>
                    <span class="count_bottom "><i class="green"><i class="fa fa-sort-desc"></i>
                    <?php
                      $avg = 40 + 25 + 35 + 12 + 24 + 20 + 10;
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)((13 - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a1_4" data-toggle="modal" data-target=".a1_4" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b1_4" data-toggle="modal" data-target=".b2_1" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a1_4" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">白菜 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart1_4" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> 木瓜</span></br>
                    <img src="img1_5.jpg" height="80" width="100%"/>
                    
                    <div class="count green">
                      20<span> 元/公斤</span> 
                    </div>
                    <span class="count_bottom "><i class="green"><i class="fa fa-sort-desc"></i>
                    <?php
                      $avg = 26 + 33.9 + 18.5 + 22.6 + 17 + 29 + 33.7;
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)((20 - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a1_5" data-toggle="modal" data-target=".a1_5" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b1_5" data-toggle="modal" data-target=".b1_5" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a1_5" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">木瓜 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart1_5" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b1_5" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=木瓜沙拉" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">木瓜沙拉</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1_5_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab1_5_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab1_5_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab1_5_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b1_5.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>木瓜1個、甜玉米1條、西洋芹1支、青花菜40公克。</p>
                                        <p>青花菜40公克。</p>
                                        <h4>調味料：</h4>
                                        <p>美乃滋200g。</p>
                                        <h4>作法：</h4>
                                        <ul >
                                          <li>木瓜洗淨去子，用挖球器挖出木瓜肉備用。</li>
                                          <li>甜玉米、青花菜洗淨水煮後撈起，與西洋芹去老筋一起置於冰水中，撈出瀝乾水分，甜玉米切塊，青花菜切小朵、西洋芹切片。</li>
                                          <li>將所有備好的木瓜、蔬菜材料依續排入盤中，，淋上香甜的美乃滋即可。</li>
                                        </ul>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1_5_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>木瓜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 木瓜具有健脾消食的功效。對身體的吸收消化有促進的作用，木瓜中的蛋白酶是很特殊的，可將我們人體的脂肪進行有效分解，然後形成脂肪酸，並能消化蛋白質，有利於對我們常吃的食物進行吸收和消化，故有健脾消食的良效。</p>
                                          <p class="excerpt"> 木瓜具有抗癌的功效。木瓜中的番木瓜鹼除了對結核桿菌和寄生蟲有很好的抵抗作用外，還具有治療淋巴性白血病和淋巴性白血病（血癌）等。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>玉米</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">  玉米含有大量的膳食纖維，能夠潤腸道排腸毒，從而達到瘦小腹的效果，而且膳食纖維在腸道裡會膨脹，增加你的飽腹感。另外，玉米所含的鎂元素也有利於腸胃蠕動，幫助消化吸收，促進體內廢物的排泄。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>芹菜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">  芹菜有平肝清熱、祛風利溼、除煩消腫、解毒宣肺、健胃利血、清腸利便、潤胃止咳、降血壓等功效。芹菜雖具有利尿、降血壓等功效，但性寒，男性多食會抑制精蟲活動力，導致不孕。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>青花菜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 青花菜源自義大利，在台灣又被慣稱為花椰菜、綠花椰，冬天為其盛產季，一直都在抗癌蔬菜榜上有名。</p>
                                          <p class="excerpt"> 其中所富含的β-胡蘿蔔素、葉黃素、葡萄硫素、檞皮素、葉酸鹽等含硫植物化學素，均是對身體有幫助的抗氧化劑，不僅有防癌效果，還有保護心血管疾病、預防黃斑部病變的發生機率。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1_5_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"木瓜沙拉");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> 香蕉</span></br>
                    <img src="img1_6.jpg" height="80" width="100%"/>
                    
                    <div class="count green">
                      10<span> 元/公斤</span> 
                    </div>
                    <span class="count_bottom "><i class="green"><i class="fa fa-sort-desc"></i>
                    <?php
                      $avg = 7.9 + 8.7 + 6.2 + 6.3 + 9.3 + 11.7 + 8;
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)((10 - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a1_6" data-toggle="modal" data-target=".a1_5" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    
                    <!-- -->
                    <div class="modal fade a1_6" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">木瓜 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart1_6" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                

                </div>
              </div>
            </div>
          </div>
          <!-- /tiles row-->

          <!-- tiles row-->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>今日漲最多食材 <small>與上周平均價格比較</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="row tile_count">

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-down"></i> 土魠</span></br>
                    <img src="img2_1.jpg" height="80" width="100%"/>
                    
                    <div class="count red">
                      <?php
                      //土魠
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=1&$skip=0&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%9C%9F%E9%AD%A0&StartDate=1061125';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);
                      echo $json[0]["平均價"];          
                      ?>
                      <span>元/斤</span> 
                    </div>
                    <span class="count_bottom "><i class="red"><i class="fa fa-sort-asc"></i>
                    <?php
                      //土魠
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=7&$skip=1&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%9C%9F%E9%AD%A0';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);

                      $avg = 0;
                      foreach ($json as $row) {
                        $avg += (float) $row["平均價"];

                      }
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)(($json[0]["平均價"] - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a2_1" data-toggle="modal" data-target=".a2_1" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b2_1" data-toggle="modal" data-target=".b2_1" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a2_1" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">土魠 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart2_1" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b2_1" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=土魠魚羔" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">土魠魚羔</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab2_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab2_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b1.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>土魠魚半斤、山東白菜1斤、香菇2兩(切絲)、鹽2茶匙、味精少許。</p>
                                        <p>醬油半碗、糖1茶匙、太白粉2湯匙。</p>
                                        <h4>作法：</h4>
                                        <ul >
                                          <li>土魠魚切成姆指大小，放入2料中浸泡30分鐘，沾上蕃薯粉後 ，放入沸油中以中火炸至金黃色撈出備用。</li>
                                          <li>山東白菜切成手掌大，油沸倒入炒軟，加水4－5碗及香菇絲滾 約3分鐘，放入味精以太白粉芶芡，再放入魚塊攪拌即可。</li>
                                        </ul>
                                        <h4>註：食用時，淋上烏醋及胡椒粉或放少許香菜，口味更佳</h4>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>土魠魚</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">學名馬鮫魚，一般長為25至50厘米，體重300至1000克。身體銀灰色，具有暗色橫紋，肋下有灰色斑點，分布於北太平洋西部、產於東海、黃海、渤海和南海。在產區，以大洲島海域出產為佳。</p>
                                          <p class="excerpt">幼魚以甲殼類、魚類等為食，長大以後為食魚性動物，主要以鯷魚等為食。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>白菜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">主要產地在彰化溪州、雲林土庫、雲林西螺，最佳食用季節為秋冬季，大白菜在生長時，由內向外生長，最先長出來的葉子在最外層。選購時以無腐心、外葉翠綠、結球緊密完整，且具重量感者為佳。愈是渾圓的大白菜，賣相愈好，價格也較高。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>香菇</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">主要產地在台灣台中新社、南投埔里、新竹尖石、五峰，產季為冬菇12～3月、夏菇4～6月。</p>
                                          <p class="excerpt">吃香菇可以預防骨質疏鬆症，因為太陽曬過的香菇富含可以幫助鈣質吸收的維生素D2。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"土托魚羔");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-down"></i> 吳郭魚</span></br>
                    <img src="img2_2.jpg" height="80" width="100%"/>
                    
                    <div class="count red">
                      <?php
                      //吳郭魚
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=1&$skip=0&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%90%B3%E9%83%AD%E9%AD%9A&StartDate=1061125';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);
                      if(!empty($json))
                        echo $json[0]["平均價"]; 
                      else
                        echo "休市";         
                      ?>
                      <span>元/條</span> 
                    </div>
                    <span class="count_bottom "><i class="red"><i class="fa fa-sort-asc"></i>
                    <?php
                      //吳郭魚
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=7&$skip=1&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%90%B3%E9%83%AD%E9%AD%9A';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);

                      $avg = 0;
                      foreach ($json as $row) {
                        $avg += (float) $row["平均價"];

                      }
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)(($json[0]["平均價"] - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a2_2" data-toggle="modal" data-target=".a2_2" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b2_2" data-toggle="modal" data-target=".b2_2" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a2_2" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">吳郭魚 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart2_2" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b2_2" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=吳郭戲水" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">吳郭戲水</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab2_2_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_2_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_2_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab2_2_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b1.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>吳郭魚(大)1條、麵粉2湯匙、炸油半鍋、油3湯匙、蔥段12枝、高湯1杯。</p>
                                        <p>胡蘿蔔(或洋火腿)2兩、香菇4朵(泡軟)、筍1支(切絲)、鹽1 1/2茶匙、味精1/4茶匙、酒1茶匙。</p>
                                        <p>水1湯匙、太白粉1湯匙。</p>
                                        <h4>調味料：</h4>
                                        <p>料理米酒、精鹽、芥末醬1茶匙、蕃茄醬2大匙、沙拉醬3大匙</p>
                                        <h4>作法：</h4>
                                        <ul >
                                          <li>魚去鱗鰓內臟洗淨，在魚身斜劃三刀，抹酒鹽一茶匙、醃十分鐘 ，沾乾麵粉，用細竹籤固定成弓型，油炸至金黃撈起立於盤中。</li>
                                          <li>爆香蔥段，加入2料炒熟後，加入高湯滾後，調味並以3料勺欠，淋於魚身即可。</li>
                                        </ul>
                                        <h4>營養成分</h4>
                                        <p>熱量971卡、蛋白質73克、脂肪61克、醣類31克。</p>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_2_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>吳郭魚</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">台灣水產史料記載兩位台籍日本兵吳振輝及郭啟彰於1946年從新加坡返台時，引進莫三比克口孵非鯽，因此稱作吳郭魚，又稱南洋鯽仔。</p>
                                          <p class="excerpt"> 引進台灣後大量養殖，其肉質鮮嫩，小刺少，雖然微有土腥味，但因養殖容易、價格便宜等因素，成為大眾食物蛋白質的重要來源。唯目前台灣人工養殖的口孵非鯽與非鯽大多是後來由台灣水產試驗所及台灣水產業者育成的雜交種。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>胡蘿蔔</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">原產於中亞西亞一帶，元代末傳入中國。胡蘿蔔是一種難得的果、蔬、藥兼用品。</p>
                                          <p class="excerpt">胡蘿蔔含有大量的胡蘿蔔素，胡蘿蔔素在人體內可以很快轉化為維生素A，對人體，特別是對老年人能產生明目養神，防治呼吸道感染，調節新陳代謝，增強抵抗力等作用。</p>
                                          <p class="excerpt">每年約於農曆八月中播種，經過灌溉、施肥、噴藥、疏株及不斷的培土，大約經過五個月的生長就可以收成，採收後的胡蘿蔔會先送到冷凍廠處理，經過清洗、分級、裝箱後，便直接送入冷凍庫冷藏，之後視市場需要才銷售到市面上去。</P>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>香菇</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">主要產地在台灣台中新社、南投埔里、新竹尖石、五峰，產季為冬菇12～3月、夏菇4～6月。</p>
                                          <p class="excerpt">吃香菇可以預防骨質疏鬆症，因為太陽曬過的香菇富含可以幫助鈣質吸收的維生素D2。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>蔥</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">別名青蔥、大蔥，常作為一種很普遍的香料調味品或蔬菜食用，在東方烹調中佔有重要的角色。</p>
                                          <p class="excerpt">蔥有較強的殺菌作用，特別是對痢疾桿菌和皮膚真菌抑制作用比較明顯。本品亦能刺激汗腺，有發汗作用，並能促進消化液分泌，有健胃作用。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>筍</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">是指幼竹莖稈的幼嫩生長部分。還沒有完全從地底下長出來時，以及剛剛出土仍未木質化的部分可作為蔬菜食用。</p>
                                          <p class="excerpt">筍乾燒，以筍飯等的形式食用。烹調時候需要去掉澀味，筍亦可以炒食。筍乾味道鮮美，可燒肉或加水煮湯。現在，也有將筍乾再精細加工，做成小包裝，成為休閒食品。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_2_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"吳郭戲水");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-down"></i> 茼蒿</span></br>
                    <img src="img2_3.jpg" height="80" width="100%"/>
                    
                    <div class="count red">
                      <?php
                      //茼蒿
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=1&$skip=0&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%90%B3%E9%83%AD%E9%AD%9A&StartDate=1061125';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);
                      if(!empty($json))
                        echo $json[0]["平均價"]; 
                      else
                        echo "休市";         
                      ?>
                      <span>元/條</span> 
                    </div>
                    <span class="count_bottom "><i class="red"><i class="fa fa-sort-asc"></i>
                    <?php
                      //吳郭魚
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=7&$skip=1&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%90%B3%E9%83%AD%E9%AD%9A';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);

                      $avg = 0;
                      foreach ($json as $row) {
                        $avg += (float) $row["平均價"];

                      }
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)(($json[0]["平均價"] - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a2_3" data-toggle="modal" data-target=".a2_3" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b2_3" data-toggle="modal" data-target=".b2_3" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a2_3" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">茼蒿 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart2_3" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b2_3" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=蒜炒茼蒿" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">蒜炒茼蒿</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab2_3_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_3_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_3_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab2_3_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b2_3.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>茼蒿、大蒜 </p>
                                        <h4>調味料：</h4>
                                        <p>油、鹽、味精</p>
                                        <h4>作法：</h4>
                                        <ul>
                                          <li>茼蒿洗凈，摘成小段</li>
                                          <li>大蒜3粒，切碎</li>
                                          <li>起油，油熱後放大蒜，加茼蒿煸炒</li>
                                          <li>茼蒿放進時快速放少許熱水</li>
                                          <li>炒2分鐘後加鹽、味精，關火即可</li>
                                        </ul>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_3_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>茼蒿</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"></p>
                                          <p class="excerpt">大葉茼蒿：葉面寬大，葉厚，嫩枝短而粗，纖維少，品質好，產量高，但生長較慢，栽培比較普遍。</p>
                                          <p class="excerpt">小葉茼蒿：葉狹小，缺刻多而深，葉薄，但香味濃，生長快，品質較差。 
                                          茼蒿為短日照一年生草本植物，為菊科植物的一員，不耐高溫，生長適溫為20度左右。</p>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>蒜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">蒜是多年生宿根草本植物，大蒜的品種多，按照鱗莖外皮的色澤可分為紫皮蒜與白皮蒜兩種。分布在華北、西北與東北等地，耐寒力弱，多在春季播種，成熟期晚；白皮蒜有大瓣和小瓣兩種，辛辣味較淡，比紫皮蒜耐寒，多秋季播種，成熟期略早。</p>
                                          <p class="excerpt">大蒜中的有機硫化合物能有效抑制大腸癌細胞，抗癌成分能讓癌細胞週期停滯，直到死亡。</p>
                                        </div>
                                      </div>
                                    </li>
                                    
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_3_3" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"蒜炒茼蒿");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-down"></i> 芥菜</span></br>
                    <img src="img2_4.jpg" height="80" width="100%"/>
                    
                    <div class="count red">
                      <?php
                      //芥菜
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=1&$skip=0&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%90%B3%E9%83%AD%E9%AD%9A&StartDate=1061125';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);
                      if(!empty($json))
                        echo $json[0]["平均價"]; 
                      else
                        echo "休市";         
                      ?>
                      <span>元/條</span> 
                    </div>
                    <span class="count_bottom "><i class="red"><i class="fa fa-sort-asc"></i>
                    <?php
                      //吳郭魚
                      $url = 'http://data.coa.gov.tw/Service/OpenData/FromM/AquaticTransData.aspx?$top=7&$skip=1&MarketName=%E6%96%B0%E7%AB%B9&TypeName=%E5%90%B3%E9%83%AD%E9%AD%9A';
                      $content = file_get_contents($url);
                      $json = json_decode($content, true);

                      $avg = 0;
                      foreach ($json as $row) {
                        $avg += (float) $row["平均價"];

                      }
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)(($json[0]["平均價"] - $avg) / $avg * 100),0);
             
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a2_4" data-toggle="modal" data-target=".a2_4" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    &nbsp;
                    <a href="" id="b2_4" data-toggle="modal" data-target=".b2_4" title="食譜製作"><i class="fa fa-book red"></i>食譜</a>
                    
                    <!-- -->
                    <div class="modal fade a2_4" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">芥菜 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart2_4" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->

                    <!-- -->
                    <div class="modal fade b2_4" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form action="add_message.php?type=香菇燴芥菜" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">香菇燴芥菜</h4>
                          </div>
                          <div class="modal-body">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab2_4_1" role="tab" data-toggle="tab" aria-expanded="true">材料與做法</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_4_2" role="tab" data-toggle="tab" aria-expanded="false">食材小故事</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab2_4_3" role="tab" data-toggle="tab" aria-expanded="false">計算價錢(有空再做)</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab2_4_1" aria-labelledby="home-tab">
                                  <table style="white-space: normal;">
                                    <tr>
                                      <td width="25%">
                                        <img src="b2_4.jpg">
                                      </td>
                                      <td width="75%" style="padding-left: 10px;">
                                        <h4>材料：</h4>
                                        <p>鮮香菇切絲8朵、里肌肉2兩、芥菜梗1株。</p>
                                        <p> 太白粉1茶匙、蛋白1個、鹽1/2茶匙。</p>
                                        <h4>作法：</h4>
                                        <ul>
                                          <li>鮮香菇洗淨去蒂切片，里肌肉、芥菜梗切片。</li>
                                          <li>鮮香菇過油。</li>
                                          <li>芥菜梗川燙撈起泡冷水。</li>
                                          <li>里肌肉加入蛋白及太白粉過油備用。</li>
                                          <li>起油鍋加入鮮香菇、芥菜梗及里肌肉拌炒，加入高當煮開1分鐘後調味、勾芡起鍋。</li>
                                        </ul>
                                        <h4>營養成分</h4>
                                        <p>熱量971卡、蛋白質73克、脂肪61克、醣類31克。</p>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_4_2" aria-labelledby="profile-tab" style="white-space: normal;">
                                  <ul class="list-unstyled timeline">
                                    <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>香菇</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 主要產地在台灣台中新社、南投埔里、新竹尖石、五峰，產季為冬菇12～3月、夏菇4～6月。</p>
                                          <p class="excerpt"> 吃香菇可以預防骨質疏鬆症，因為太陽曬過的香菇富含可以幫助鈣質吸收的維生素D2。</p>
                                        </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>瘦肉</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt"> 瘦肉有三個部位；小里肌肉、臀尖肉、坐臀肉，其中小里肌肉是脊骨下面一條與大排骨相連的瘦肉。肉中無筋，是豬肉中最嫩的一部分。水分含量多，脂肪含量低，肌肉纖維細小，炸、、炒、爆等烹調方法都適合。</p>
                                          <p class="excerpt"> 臀尖肉位於臀部的上面，都是瘦肉，肉質鮮嫩，烹調時可用來代替裡脊肉。</p>
                                      <p class="excerpt">  坐臀肉位於后腿上方，臀尖肉下方。全為瘦肉，但肉質較老，纖維較長，一般多在做白切肉或回鍋肉時用。</p>
                                    </div>
                                      </div>
                                    </li>
                                  <li>
                                      <div class='block'>
                                        <div class='tags'>
                                          <a class='tag'>
                                            <span>芥菜</span>
                                          </a>
                                        </div>
                                        <div class='block_content'>
                                          <p class="excerpt">  芹菜有平肝清熱、祛風利溼、除煩消腫、解毒宣肺、健胃利血、清腸利便、潤胃止咳、降血壓等功效。芹菜雖具有利尿、降血壓等功效，但性寒，男性多食會抑制精蟲活動力，導致不孕。</p>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2_4_1" aria-labelledby="profile-tab">
                                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                    booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-body">
                            <h4>網友留言</h4>
                            <ul class="list-unstyled timeline">
                              <?php
  
                                $SQLcmd = "SELECT * FROM message WHERE name=:NAME ORDER BY id DESC";
                                $var = array( ':NAME'=>"吳郭戲水");
                                $arr = $dbconn->selectData( $SQLcmd, $var );
                                foreach ($arr as $row) {
                                  echo  
                                    "
                                      <li>
                                        <div class='block'>
                                          <div class='tags'>
                                            <a href='' class='tag'>
                                              <span>".$row['user']."</span>
                                            </a>
                                          </div>
                                          <div class='block_content'>
                                            <h2 class='title'>".$row['msg']."</h2>
                                            <div class='byline'>
                                              <span>".$row['time']."</span>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    ";
                                }

                              ?>
                            </ul>
                          </div>
                          <div class="modal-body">
                            <label for="fullname">暱稱 (可不填):</label>
                            <input type="text" name="user" class="form-control" />
                            <label for="message">請輸入留言:</label>
                            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button id="add" type="submit" class="btn btn-primary">留言</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-down"></i> 草莓</span></br>
                    <img src="img2_5.jpg" height="80" width="100%"/>
                    
                    <div class="count red">
                      129<span> 元/公斤</span> 
                    </div>
                    <span class="count_bottom "><i class="red"><i class="fa fa-sort-asc"></i>
                    <?php
                      $avg = 142.9 + 79 + 50.5 + 43 + 123 + 120 + 110;
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)((129 - $avg) / $avg * 100),0);  
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a2_5" data-toggle="modal" data-target=".a2_5" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    
                    <!-- -->
                    <div class="modal fade a2_5" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">草莓 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart2_5" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->

                  <!-- col-md-2 col-sm-4 -->
                  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-down"></i> 西瓜</span></br>
                    <img src="img2_6.jpg" height="80" width="100%"/>
                    <div class="count red">
                      18<span> 元/公斤</span> 
                    </div>
                    <span class="count_bottom "><i class="red"><i class="fa fa-sort-asc"></i>
                    <?php
                      $avg = 14 + 28 + 14 + 14 + 14 + 14 + 10;
                      $avg = $avg / 7;
                      //abs()
                      echo $compare_week = round((float)((18 - $avg) / $avg * 100),0);  
                    ?>%&nbsp;
                    </i> </span>
                    <a href="" id="a2_6" data-toggle="modal" data-target=".a2_6" title="近期趨勢"><i class="fa fa-line-chart red"></i>趨勢</a>
                    
                    <!-- -->
                    <div class="modal fade a2_6" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">西瓜 近期走勢</h4>
                          </div>
                          <div class="modal-body">
                              <div id="chart2_6" style="height:400px;width:800px"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / -->
                  </div>
                  <!-- /col-md-2 col-sm-4 -->
              

                </div>
              </div>
            </div>
          </div>
          <!-- /tiles row-->

          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>500元最省套餐 <small>2人份</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="thumbnail ">
                    <div class="image view view-first">
                      <img style="width: 100%; display: block;" src="small_cbc072509a34c842.jpg" alt="image" />
                      <div class="mask">
                        <p>Your Text</p>
                        <div class="tools tools-bottom">
                          <a href="#"><i class="fa fa-link"></i></a>
                          <a href="#"><i class="fa fa-pencil"></i></a>
                          <a href="#"><i class="fa fa-times"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="caption">
                      <a class="title" href="#">鹹派(培根花椰菜、雪白菇雞肉)</a>
                      <p>鹹派的內餡，完全是看自己的喜好，喜歡什麼炒什麼然後再把內餡奶油醬倒進去就好！</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>1000元最省套餐</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                
       
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12 ">
              <div class="x_panel ui-ribbon-container fixed_height_320">
                <div class="ui-ribbon-wrapper ">
                  <div class="ui-ribbon">
                    30% Off
                  </div>
                </div>
                <div class="x_title">
                  <h2>1500元最省套餐</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">雞胸肉一只</a></li>
                      <li><i class="fa fa-bars"></i><a href="#">新鮮山藥200g</a></li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">蔥、蒜各5g</a> </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">生菜葉200g</a> </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">蛋2只</a> </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">...</a> </li>
                      <li>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">
                        製作步驟
                        </button>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                        <h4>吉利酥香黃金雞排</h4>
                        <img src="cc.jpg" style="width: 160px; height: 100px;">
                    </div>   
                  </div>                

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">國宴級黃金雞排料理</h4>
                        </div>
                        <div class="modal-body">
                          <img src="cc.jpg" width="40%">
                          <h4>材料：</h4>
                          <p>雞胸肉一只、新鮮山藥200g、蔥、蒜各5g、生菜葉200g、蛋2只、中或低筋麵粉200g、麵包粉300g、衛生冰塊200g</p>
                          <h4>調味料：</h4>
                          <p>料理米酒、精鹽、芥末醬1茶匙、蕃茄醬2大匙、沙拉醬3大匙</p>
                          <h4>作法：</h4>
                          <ul >
                            <li>雞胸肉以蔥、蒜、酒、鹽醃味，沾麵粉、全蛋汁、麵包粉，用150度油溫炸3分鐘，擺盤。</li>
                            <li>山藥切4公分長，1.5公分寬的條狀，用衛生冰塊水冰鎮後備用。</li>
                            <li>蕃茄醬2大匙、沙拉醬3大匙、芥末醬1茶匙混合備用。</li>
                            <li>將山藥滴乾水分，生菜葉排盤，炸好的雞排排盤，淋上作法3醬料即可。</li>
                          </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal">我會做了</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- ECharts -->
    <script src="../vendors/echarts/dist/echarts.min.js"></script>
    <script src="../vendors/echarts/map/js/world.js"></script>

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>

    <script type="text/javascript">   
        

        // 路径配置
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        
        // 使用
        require(
            [
                'echarts',
                'echarts/chart/bar', // 使用柱状图就加载bar模块，按需加载
                'echarts/chart/line' 
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表

                /**
                  草蝦
                **/
                $( "#a1_1" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart1_1')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '草蝦',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/2", "2015/1/3", "2015/1/4", "2015/1/6", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/10", "2015/1/11", "2015/1/13", "2015/1/14", "2015/1/15", "2015/1/16", "2015/1/17", "2015/1/18", "2015/1/20", "2015/1/21", "2015/1/22", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/28", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/5", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/15", "2015/2/16", "2015/2/17", "2015/2/18", "2015/2/25", "2015/2/26", "2015/2/27", "2015/2/28", "2015/3/1", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/10", "2015/3/11", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/15", "2015/3/17", "2015/3/18", "2015/3/19", "2015/3/20", "2015/3/21", "2015/3/22", "2015/3/24", "2015/3/25", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/5", "2015/4/11", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/16", "2015/4/17", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/22", "2015/4/23", "2015/4/24", "2015/4/25", "2015/4/26", "2015/4/28", "2015/4/29", "2015/4/30", "2015/5/1", "2015/5/2", "2015/5/3", "2015/5/5", "2015/5/6", "2015/5/7", "2015/5/8", "2015/5/9", "2015/5/10", "2015/5/12", "2015/5/13", "2015/5/14", "2015/5/15", "2015/5/16", "2015/5/17", "2015/5/19", "2015/5/20", "2015/5/21", "2015/5/22", "2015/5/23", "2015/5/24", "2015/5/26", "2015/5/27", "2015/5/28", "2015/5/29", "2015/5/30", "2015/5/31", "2015/6/2", "2015/6/3", "2015/6/4", "2015/6/5", "2015/6/6", "2015/6/7", "2015/6/9", "2015/6/10", "2015/6/11", "2015/6/12", "2015/6/13", "2015/6/14", "2015/6/16", "2015/6/17", "2015/6/18", "2015/6/19", "2015/6/20", "2015/6/23", "2015/6/24", "2015/6/25", "2015/6/26", "2015/6/27", "2015/6/28", "2015/6/30", "2015/7/1", "2015/7/2", "2015/7/3", "2015/7/4", "2015/7/5", "2015/7/7", "2015/7/8", "2015/7/9", "2015/7/10", "2015/7/11", "2015/7/12", "2015/7/14", "2015/7/15", "2015/7/16", "2015/7/17", "2015/7/18", "2015/7/19", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/24", "2015/7/25", "2015/7/26", "2015/7/28", "2015/7/29", "2015/7/30", "2015/7/31", "2015/8/1", "2015/8/2", "2015/8/4", "2015/8/5", "2015/8/6", "2015/8/7", "2015/8/9", "2015/8/11", "2015/8/12", "2015/8/13", "2015/8/14", "2015/8/15", "2015/8/16", "2015/8/18", "2015/8/19", "2015/8/20", "2015/8/21", "2015/8/22", "2015/8/23", "2015/8/25", "2015/8/26", "2015/8/27", "2015/8/28", "2015/9/1", "2015/9/2", "2015/9/3", "2015/9/4", "2015/9/5", "2015/9/6", "2015/9/8", "2015/9/9", "2015/9/10", "2015/9/11", "2015/9/12", "2015/9/13", "2015/9/15", "2015/9/16", "2015/9/17", "2015/9/18", "2015/9/19", "2015/9/20", "2015/9/22", "2015/9/23", "2015/9/24", "2015/9/25", "2015/9/26", "2015/9/27", "2015/9/30", "2015/10/1", "2015/10/2", "2015/10/3", "2015/10/4", "2015/10/6", "2015/10/7", "2015/10/8", "2015/10/9", "2015/10/10", "2015/10/11", "2015/10/13", "2015/10/14", "2015/10/15", "2015/10/16", "2015/10/17", "2015/10/18", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/24", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/29", "2015/10/30", "2015/10/31", "2015/11/1", "2015/11/3", "2015/11/4", "2015/11/5", "2015/11/6", "2015/11/7", "2015/11/8", "2015/11/10", "2015/11/11", "2015/11/12", "2015/11/13", "2015/11/14", "2015/11/15", "2015/11/17", "2015/11/18", "2015/11/19", "2015/11/20", "2015/11/21", "2015/11/22", "2015/11/24", "2015/11/25", "2015/11/26", "2015/11/27", "2015/11/28", "2015/11/29", "2015/12/1", "2015/12/2", "2015/12/3", "2015/12/4", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/9", "2015/12/10", "2015/12/11", "2015/12/12", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/17", "2015/12/18", "2015/12/19", "2015/12/20", "2015/12/22", "2015/12/23", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/27", "2015/12/29", "2015/12/30", "2015/12/31", "2016/1/1", "2016/1/2", "2016/1/3", "2016/1/5", "2016/1/6", "2016/1/7", "2016/1/8", "2016/1/9", "2016/1/10", "2016/1/12", "2016/1/13", "2016/1/14", "2016/1/15", "2016/1/16", "2016/1/17", "2016/1/19", "2016/1/20", "2016/1/21", "2016/1/22", "2016/1/23", "2016/1/24", "2016/1/26", "2016/1/27", "2016/1/28", "2016/1/29", "2016/1/30", "2016/1/31", "2016/2/2", "2016/2/3", "2016/2/4", "2016/2/5", "2016/2/6", "2016/2/7", "2016/2/16", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/21", "2016/2/24", "2016/2/25", "2016/2/26", "2016/2/27", "2016/2/28", "2016/3/1", "2016/3/2", "2016/3/3", "2016/3/4", "2016/3/5", "2016/3/6", "2016/3/8", "2016/3/9", "2016/3/10", "2016/3/11", "2016/3/12", "2016/3/13", "2016/3/15", "2016/3/16", "2016/3/17", "2016/3/18", "2016/3/19", "2016/3/20", "2016/3/22", "2016/3/23", "2016/3/24", "2016/3/25", "2016/3/26", "2016/3/27", "2016/3/29", "2016/3/30", "2016/3/31", "2016/4/1", "2016/4/2", "2016/4/3", "2016/4/4", "2016/4/10", "2016/4/12", "2016/4/13", "2016/4/14", "2016/4/15", "2016/4/16", "2016/4/17", "2016/4/19", "2016/4/20", "2016/4/21", "2016/4/22", "2016/4/23", "2016/4/24", "2016/4/26", "2016/4/27", "2016/4/28", "2016/4/29", "2016/4/30", "2016/5/1", "2016/5/3", "2016/5/4", "2016/5/5", "2016/5/6", "2016/5/7", "2016/5/8", "2016/5/10", "2016/5/11", "2016/5/12", "2016/5/13", "2016/5/14", "2016/5/15", "2016/5/17", "2016/5/18", "2016/5/19", "2016/5/20", "2016/5/21", "2016/5/22", "2016/5/24", "2016/5/25", "2016/5/26", "2016/5/27", "2016/5/28", "2016/5/29", "2016/5/31", "2016/6/1", "2016/6/2", "2016/6/3", "2016/6/4", "2016/6/5", "2016/6/7", "2016/6/8", "2016/6/9", "2016/6/12", "2016/6/14", "2016/6/15", "2016/6/16", "2016/6/17", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/23", "2016/6/24", "2016/6/25", "2016/6/26", "2016/6/28", "2016/6/29", "2016/6/30", "2016/7/1", "2016/7/2", "2016/7/3", "2016/7/5", "2016/7/6", "2016/7/7", "2016/7/8", "2016/7/9", "2016/7/10", "2016/7/12", "2016/7/13", "2016/7/14", "2016/7/15", "2016/7/16", "2016/7/17", "2016/7/19", "2016/7/20", "2016/7/21", "2016/7/22", "2016/7/23", "2016/7/24", "2016/7/26", "2016/7/27", "2016/7/28", "2016/7/29", "2016/7/30", "2016/7/31", "2016/8/2", "2016/8/3", "2016/8/4", "2016/8/5", "2016/8/6", "2016/8/7", "2016/8/9", "2016/8/10", "2016/8/11", "2016/8/12", "2016/8/13", "2016/8/14", "2016/8/16", "2016/8/17", "2016/8/20", "2016/8/21", "2016/8/23", "2016/8/24", "2016/8/25", "2016/8/26", "2016/8/27", "2016/8/28", "2016/8/30", "2016/8/31", "2016/9/1", "2016/9/2", "2016/9/3", "2016/9/4", "2016/9/6", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/10", "2016/9/11", "2016/9/13", "2016/9/14", "2016/9/15", "2016/9/16", "2016/9/17", "2016/9/21", "2016/9/22", "2016/9/23", "2016/9/24", "2016/9/25", "2016/9/27", "2016/9/28", "2016/9/29", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/9", "2016/10/11", "2016/10/12", "2016/10/13", "2016/10/14", "2016/10/15", "2016/10/16", "2016/10/18", "2016/10/19", "2016/10/20", "2016/10/21", "2016/10/22", "2016/10/23", "2016/10/25", "2016/10/26", "2016/10/27", "2016/10/28", "2016/10/29", "2016/10/30", "2016/11/1", "2016/11/2", "2016/11/3", "2016/11/4", "2016/11/5", "2016/11/6", "2016/11/8", "2016/11/9", "2016/11/10", "2016/11/11", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/16", "2016/11/17", "2016/11/18", "2016/11/19", "2016/11/20", "2016/11/22", "2016/11/23", "2016/11/24", "2016/11/25", "2016/11/26", "2016/11/27", "2016/11/29", "2016/11/30", "2016/12/1", "2016/12/2", "2016/12/3", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/8", "2016/12/9", "2016/12/10", "2016/12/11", "2016/12/13", "2016/12/14", "2016/12/15", "2016/12/16", "2016/12/17", "2016/12/18", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/24", "2016/12/25", "2016/12/27", "2016/12/28", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/3", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/11", "2017/1/12", "2017/1/13", "2017/1/14", "2017/1/15", "2017/1/17", "2017/1/18", "2017/1/19", "2017/1/20", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/1/26", "2017/1/27", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/15", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/19", "2017/2/21", "2017/2/22", "2017/2/23", "2017/2/24", "2017/2/25", "2017/2/26", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/3", "2017/3/4", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/3", "2017/4/4", "2017/4/11", "2017/4/12", "2017/4/13", "2017/4/14", "2017/4/15", "2017/4/16", "2017/4/18", "2017/4/19", "2017/4/20", "2017/4/21", "2017/4/22", "2017/4/23", "2017/4/25", "2017/4/26", "2017/4/27", "2017/4/28", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/3", "2017/5/4", "2017/5/5", "2017/5/6", "2017/5/7", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/16", "2017/5/17", "2017/5/18", "2017/5/19", "2017/5/20", "2017/5/21", "2017/5/23", "2017/5/24", "2017/5/25", "2017/5/26", "2017/5/27", "2017/5/28", "2017/5/29", "2017/5/30", "2017/6/2", "2017/6/3", "2017/6/4", "2017/6/6", "2017/6/7", "2017/6/8", "2017/6/9", "2017/6/10", "2017/6/11", "2017/6/13", "2017/6/14", "2017/6/15", "2017/6/16", "2017/6/17", "2017/6/18", "2017/6/20", "2017/6/21", "2017/6/22", "2017/6/23", "2017/6/24", "2017/6/25", "2017/6/27", "2017/6/28", "2017/6/29", "2017/6/30", "2017/7/1", "2017/7/2", "2017/7/4", "2017/7/5", "2017/7/6", "2017/7/7", "2017/7/8", "2017/7/9", "2017/7/11", "2017/7/12", "2017/7/13", "2017/7/14", "2017/7/15", "2017/7/16", "2017/7/18", "2017/7/19", "2017/7/20", "2017/7/21", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/27", "2017/7/28", "2017/7/29", "2017/7/30", "2017/8/1", "2017/8/2", "2017/8/3", "2017/8/4", "2017/8/5", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/12", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/17", "2017/8/18", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/26", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/1", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/14", "2017/9/15", "2017/9/16", "2017/9/17", "2017/9/19", "2017/9/20", "2017/9/21", "2017/9/22", "2017/9/23", "2017/9/24", "2017/9/26", "2017/9/27", "2017/9/28", "2017/9/29", "2017/9/30", "2017/10/1", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/14", "2017/10/15", "2017/10/17", "2017/10/18", "2017/10/19", "2017/10/20", "2017/10/21", "2017/10/22", "2017/10/24", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/1", "2017/11/2", "2017/11/3", "2017/11/4", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/12", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/20", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/8"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data":[120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.5, 120, 120, 120, 120, 121, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 124.7, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 105.6, 120, 120, 120, 120.6, 119.4, 120, 88.8, 120, 120, 120, 120, 120, 120, 120, 120, 120, 117, 99.9, 109.2, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.6, 119.1, 120, 120, 120.3, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 111.1, 120, 114.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 119.6, 120, 120, 120, 120, 120, 120, 120, 117.5, 120, 120, 120, 120, 120, 120, 120, 114.1, 120, 120, 120, 120, 120, 119.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 121.6, 117.1, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 118.4, 120, 120, 120, 120, 120, 118.5, 120, 120, 120, 120, 120, 120, 120, 120.1, 120, 120, 120, 120, 120, 120, 120, 112.3, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 115, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 127.9, 128.5, 127.9, 120, 120, 120, 120, 120, 120, 120, 120, 120, 123.5, 120, 120, 120.5, 120, 120, 120, 120, 120, 121.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 127, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 112, 117, 120, 117.2, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 114.9, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 118.6, 114.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 139.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 145.6, 100, 120, 120, 120, 120.4, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.9, 118.1, 105.5, 118.6, 120, 120, 120, 120, 120, 120, 93.3, 120, 120, 120, 117.8, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 115.8, 119.2, 120, 115.4, 105.7, 118.7, 120, 120, 120, 120, 120, 120, 114.9, 104, 120, 105.6, 115.6, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.9, 120, 120, 120, 120, 122.9, 120, 120, 120, 120, 120, 120, 120, 120, 120, 109.9, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.6, 125.5, 120, 127.1, 120, 120, 120, 133.4, 137.2, 120, 120, 133.8, 128.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 135, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 117.3, 121.6, 120.2, 121.3, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.2, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 118.8, 113.9, 108, 120, 120, 120, 120, 120, 120, 120.6, 120, 120.9, 116.8, 120, 120, 120, 120, 117.1, 120, 117.3, 120, 120, 113.9, 120, 117.5, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 118.5, 120, 120, 120, 120, 120, 120, 120, 120, 119.9, 119.3, 120, 113.4, 120, 120, 120, 120, 120.1, 120, 120, 120, 120, 120.8, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120.1, 120, 120, 119.8, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 119.6, 114.5, 113.8, 111, 112.3, 110, 120.1, 120, 120, 118.7, 120, 120, 120, 121.7, 120, 120, 120, 120, 119.3, 120.2, 120, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data":['-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 119.6, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.7, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8, 119.8] ,
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data":['-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 121.1, 121.1, 121.1, 121.1, 121.1, 121.1, 121.1, 121.1, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2, 121.2] ,
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data":['-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 118.2, 118.2, 118.2, 118.2, 118.2, 118.2, 118.2, 118.2, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3, 118.3],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  白鯧
                **/
                $( "#a1_2" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart1_2')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '白鯧',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/4", "2015/1/6", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/10", "2015/1/11", "2015/1/13", "2015/1/14", "2015/1/15", "2015/1/16", "2015/1/17", "2015/1/18", "2015/1/20", "2015/1/21", "2015/1/22", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/28", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/15", "2015/2/16", "2015/2/17", "2015/2/18", "2015/2/25", "2015/2/26", "2015/2/27", "2015/2/28", "2015/3/1", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/10", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/15", "2015/3/17", "2015/3/18", "2015/3/20", "2015/3/21", "2015/3/22", "2015/3/24", "2015/3/25", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/5", "2015/4/11", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/16", "2015/4/17", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/22", "2015/4/23", "2015/4/24", "2015/4/25", "2015/4/28", "2015/4/29", "2015/4/30", "2015/5/1", "2015/5/2", "2015/5/3", "2015/5/5", "2015/5/6", "2015/5/7", "2015/5/9", "2015/5/10", "2015/5/12", "2015/5/14", "2015/5/15", "2015/5/16", "2015/5/17", "2015/5/19", "2015/5/23", "2015/5/24", "2015/5/26", "2015/5/27", "2015/5/28", "2015/5/29", "2015/6/2", "2015/6/3", "2015/6/4", "2015/6/5", "2015/6/7", "2015/6/9", "2015/6/12", "2015/6/13", "2015/6/14", "2015/6/16", "2015/6/17", "2015/6/20", "2015/6/23", "2015/6/24", "2015/6/25", "2015/6/26", "2015/6/27", "2015/6/28", "2015/6/30", "2015/7/1", "2015/7/4", "2015/7/5", "2015/7/7", "2015/7/8", "2015/7/9", "2015/7/10", "2015/7/11", "2015/7/12", "2015/7/14", "2015/7/15", "2015/7/16", "2015/7/17", "2015/7/18", "2015/7/19", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/24", "2015/7/25", "2015/7/26", "2015/7/28", "2015/7/29", "2015/7/30", "2015/7/31", "2015/8/1", "2015/8/2", "2015/8/4", "2015/8/5", "2015/8/6", "2015/8/7", "2015/8/8", "2015/8/9", "2015/8/11", "2015/8/12", "2015/8/13", "2015/8/14", "2015/8/15", "2015/8/16", "2015/8/18", "2015/8/19", "2015/8/20", "2015/8/21", "2015/8/22", "2015/8/23", "2015/8/25", "2015/8/26", "2015/8/27", "2015/8/28", "2015/9/1", "2015/9/2", "2015/9/3", "2015/9/4", "2015/9/5", "2015/9/6", "2015/9/8", "2015/9/9", "2015/9/10", "2015/9/11", "2015/9/12", "2015/9/13", "2015/9/15", "2015/9/16", "2015/9/17", "2015/9/18", "2015/9/19", "2015/9/20", "2015/9/22", "2015/9/23", "2015/9/24", "2015/9/25", "2015/9/26", "2015/9/27", "2015/9/30", "2015/10/1", "2015/10/2", "2015/10/3", "2015/10/4", "2015/10/6", "2015/10/7", "2015/10/8", "2015/10/9", "2015/10/10", "2015/10/11", "2015/10/13", "2015/10/14", "2015/10/15", "2015/10/16", "2015/10/17", "2015/10/18", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/24", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/29", "2015/10/30", "2015/10/31", "2015/11/1", "2015/11/3", "2015/11/4", "2015/11/5", "2015/11/6", "2015/11/7", "2015/11/8", "2015/11/10", "2015/11/11", "2015/11/12", "2015/11/13", "2015/11/14", "2015/11/15", "2015/11/17", "2015/11/18", "2015/11/19", "2015/11/20", "2015/11/21", "2015/11/22", "2015/11/24", "2015/11/25", "2015/11/26", "2015/11/27", "2015/11/28", "2015/11/29", "2015/12/1", "2015/12/2", "2015/12/3", "2015/12/4", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/9", "2015/12/10", "2015/12/11", "2015/12/12", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/17", "2015/12/18", "2015/12/19", "2015/12/20", "2015/12/22", "2015/12/23", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/27", "2015/12/29", "2015/12/30", "2015/12/31", "2016/1/1", "2016/1/2", "2016/1/3", "2016/1/5", "2016/1/6", "2016/1/7", "2016/1/8", "2016/1/9", "2016/1/10", "2016/1/12", "2016/1/13", "2016/1/14", "2016/1/15", "2016/1/16", "2016/1/17", "2016/1/19", "2016/1/20", "2016/1/21", "2016/1/22", "2016/1/23", "2016/1/24", "2016/1/26", "2016/1/27", "2016/1/28", "2016/1/29", "2016/1/30", "2016/1/31", "2016/2/3", "2016/2/4", "2016/2/5", "2016/2/6", "2016/2/16", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/21", "2016/2/24", "2016/2/25", "2016/2/27", "2016/3/1", "2016/3/2", "2016/3/3", "2016/3/4", "2016/3/5", "2016/3/6", "2016/3/8", "2016/3/12", "2016/3/13", "2016/3/15", "2016/3/16", "2016/3/17", "2016/3/18", "2016/3/19", "2016/3/20", "2016/3/22", "2016/3/23", "2016/3/24", "2016/3/26", "2016/3/27", "2016/3/29", "2016/3/30", "2016/3/31", "2016/4/1", "2016/4/2", "2016/4/3", "2016/4/4", "2016/4/10", "2016/4/12", "2016/4/13", "2016/4/16", "2016/4/19", "2016/4/21", "2016/4/22", "2016/4/23", "2016/4/24", "2016/4/26", "2016/4/28", "2016/4/29", "2016/5/1", "2016/5/3", "2016/5/4", "2016/5/5", "2016/5/6", "2016/5/7", "2016/5/8", "2016/5/10", "2016/5/13", "2016/5/14", "2016/5/15", "2016/5/17", "2016/5/19", "2016/5/21", "2016/5/22", "2016/5/24", "2016/5/25", "2016/5/26", "2016/5/28", "2016/5/31", "2016/6/4", "2016/6/7", "2016/6/8", "2016/6/12", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/23", "2016/6/24", "2016/6/25", "2016/6/26", "2016/6/28", "2016/6/29", "2016/6/30", "2016/7/1", "2016/7/2", "2016/7/3", "2016/7/10", "2016/7/12", "2016/7/14", "2016/7/15", "2016/7/17", "2016/7/19", "2016/7/20", "2016/7/21", "2016/7/22", "2016/7/23", "2016/7/24", "2016/7/26", "2016/7/27", "2016/7/28", "2016/7/29", "2016/7/30", "2016/7/31", "2016/8/2", "2016/8/3", "2016/8/4", "2016/8/5", "2016/8/6", "2016/8/7", "2016/8/9", "2016/8/10", "2016/8/11", "2016/8/12", "2016/8/13", "2016/8/14", "2016/8/16", "2016/8/17", "2016/8/20", "2016/8/21", "2016/8/23", "2016/8/24", "2016/8/25", "2016/8/26", "2016/8/27", "2016/8/28", "2016/8/30", "2016/8/31", "2016/9/1", "2016/9/2", "2016/9/3", "2016/9/4", "2016/9/6", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/10", "2016/9/11", "2016/9/13", "2016/9/14", "2016/9/16", "2016/9/17", "2016/9/21", "2016/9/22", "2016/9/23", "2016/9/24", "2016/9/25", "2016/9/27", "2016/9/29", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/9", "2016/10/11", "2016/10/12", "2016/10/13", "2016/10/14", "2016/10/15", "2016/10/16", "2016/10/18", "2016/10/19", "2016/10/20", "2016/10/21", "2016/10/22", "2016/10/23", "2016/10/25", "2016/10/26", "2016/10/27", "2016/10/28", "2016/10/29", "2016/10/30", "2016/11/1", "2016/11/3", "2016/11/4", "2016/11/5", "2016/11/6", "2016/11/8", "2016/11/9", "2016/11/10", "2016/11/11", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/16", "2016/11/17", "2016/11/18", "2016/11/19", "2016/11/20", "2016/11/22", "2016/11/23", "2016/11/24", "2016/11/25", "2016/11/26", "2016/11/27", "2016/11/29", "2016/11/30", "2016/12/1", "2016/12/2", "2016/12/3", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/8", "2016/12/9", "2016/12/10", "2016/12/11", "2016/12/13", "2016/12/14", "2016/12/15", "2016/12/16", "2016/12/17", "2016/12/18", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/24", "2016/12/25", "2016/12/27", "2016/12/28", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/3", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/11", "2017/1/12", "2017/1/13", "2017/1/14", "2017/1/15", "2017/1/17", "2017/1/18", "2017/1/19", "2017/1/20", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/1/26", "2017/1/27", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/15", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/19", "2017/2/21", "2017/2/22", "2017/2/23", "2017/2/24", "2017/2/26", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/4", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/3", "2017/4/4", "2017/4/11", "2017/4/13", "2017/4/14", "2017/4/15", "2017/4/16", "2017/4/18", "2017/4/20", "2017/4/21", "2017/4/22", "2017/4/23", "2017/4/25", "2017/4/26", "2017/4/27", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/3", "2017/5/4", "2017/5/5", "2017/5/6", "2017/5/7", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/16", "2017/5/17", "2017/5/18", "2017/5/19", "2017/5/20", "2017/5/21", "2017/5/23", "2017/5/24", "2017/5/25", "2017/5/27", "2017/5/28", "2017/5/29", "2017/5/30", "2017/6/2", "2017/6/3", "2017/6/4", "2017/6/6", "2017/6/7", "2017/6/8", "2017/6/9", "2017/6/10", "2017/6/11", "2017/6/13", "2017/6/14", "2017/6/15", "2017/6/17", "2017/6/20", "2017/6/21", "2017/6/22", "2017/6/23", "2017/6/24", "2017/6/25", "2017/6/27", "2017/6/28", "2017/6/29", "2017/6/30", "2017/7/1", "2017/7/2", "2017/7/4", "2017/7/5", "2017/7/6", "2017/7/7", "2017/7/8", "2017/7/9", "2017/7/11", "2017/7/12", "2017/7/13", "2017/7/14", "2017/7/15", "2017/7/16", "2017/7/18", "2017/7/19", "2017/7/20", "2017/7/21", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/27", "2017/7/28", "2017/7/29", "2017/8/1", "2017/8/2", "2017/8/3", "2017/8/4", "2017/8/5", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/12", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/17", "2017/8/18", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/26", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/1", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/14", "2017/9/15", "2017/9/16", "2017/9/17", "2017/9/19", "2017/9/20", "2017/9/21", "2017/9/22", "2017/9/23", "2017/9/24", "2017/9/26", "2017/9/27", "2017/9/28", "2017/9/29", "2017/9/30", "2017/10/1", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/14", "2017/10/15", "2017/10/17", "2017/10/18", "2017/10/19", "2017/10/20", "2017/10/21", "2017/10/22", "2017/10/24", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/1", "2017/11/2", "2017/11/3", "2017/11/4", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/12", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13", "2018/1/14"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [199.1, 431.3, 910.5, 1133.5, 485, 630.7, 799, 657.2, 572.7, 313, 375.6, 576.8, 803.7, 747.7, 715.6, 721.5, 763, 575.1, 677.6, 445.8, 537.9, 618.3, 635, 660.2, 927.1, 691, 923.6, 574.9, 782.6, 864.6, 723.6, 706.2, 715.7, 461.7, 824.2, 740.4, 865.4, 842.5, 624.1, 202.4, 572.7, 554.3, 726.5, 846.6, 410, 888.3, 951.6, 694.4, 482.7, 902.1, 865, 624.7, 706.8, 180.2, 92.3, 507.7, 521, 852.2, 650.3, 100.1, 398.9, 1040.9, 848.8, 251.5, 417.9, 360, 122.4, 220.8, 119.9, 660, 916.6, 563.6, 444.4, 802.1, 831.3, 800, 212.9, 197.6, 528.8, 837.3, 829.3, 300.2, 775.6, 660.4, 653.1, 247.1, 882.2, 738, 685.1, 594.5, 811, 655.6, 309.7, 229, 604.9, 364.6, 214.6, 889.3, 1000, 484.6, 600, 869.1, 677.8, 400, 716.4, 245.7, 654.8, 816.7, 1113.3, 829.7, 748.9, 895.9, 906.2, 594.9, 949.3, 772.9, 853.9, 884.4, 534.4, 468.1, 466.4, 616.9, 400.3, 350, 537.5, 350, 407.6, 363.4, 353.3, 360, 377.7, 385, 386.4, 396.7, 422, 420.3, 401.6, 452.3, 465.3, 431.9, 397, 435, 438.5, 417.8, 436.9, 433.2, 512.5, 396.6, 535.6, 437.8, 503.3, 491.3, 455, 461.7, 611.4, 429.5, 423.7, 678, 533.4, 469.3, 288.7, 318.7, 397.6, 305.8, 435.8, 442.7, 267.8, 303.4, 413.9, 390.4, 550.4, 270.8, 261.2, 447.9, 365.3, 598.8, 211.5, 442.7, 440, 426.7, 635.3, 434.7, 434.1, 453.1, 322.1, 352.7, 458.9, 722.6, 962, 251.4, 274.2, 347.5, 263.2, 245.2, 354.7, 311.1, 514.6, 388.9, 420, 291.3, 219.2, 540.4, 648.7, 305.9, 305.5, 328.2, 262.9, 230.6, 313.6, 417, 602.8, 786.4, 632.7, 222.9, 222.8, 230.2, 202.2, 335.3, 258.8, 227.4, 280.4, 301.7, 206.1, 519.8, 643.3, 702.8, 242.4, 324.5, 735.9, 687.1, 336.2, 274.6, 484.8, 600.4, 212.8, 655.4, 710.1, 571.1, 617.7, 634.4, 520.4, 416.9, 536, 633.5, 575.8, 533.2, 409.4, 645.9, 420, 655.3, 708.3, 724.9, 748.7, 665.1, 666.7, 790.2, 751.9, 699.7, 693.9, 747.7, 807.2, 744, 758.3, 678.6, 679.8, 832.3, 487.5, 634.4, 704.8, 694.6, 686.9, 602.7, 614.6, 739.3, 666, 842.5, 780.7, 769.2, 510, 761.7, 757, 658.1, 202.3, 789, 570, 495.4, 542.7, 370.9, 580, 669.7, 1134, 421, 1110.4, 616, 545.9, 565.1, 493.1, 640.1, 599.3, 1027.7, 591.4, 273.9, 1112.9, 317.3, 520.2, 296.8, 283.5, 688, 790.5, 370.6, 420.7, 363.9, 269.8, 303.4, 212.5, 507.6, 105.1, 811.2, 184.6, 394.8, 295.9, 319.9, 281.7, 480, 378.5, 500, 318.6, 127.7, 648.2, 251.8, 306.5, 80.7, 994.6, 961.9, 565.2, 303.7, 68.1, 715.6, 606.4, 405.6, 396.3, 312.4, 690, 450, 1200, 249.1, 750, 800, 804.5, 1300, 1037.5, 773.8, 805.7, 933.9, 948.5, 850.9, 412.1, 955.9, 831.3, 863, 1067.9, 971.5, 1100, 1057.5, 1075.7, 974.4, 965.2, 948, 903.8, 944.7, 634.6, 673, 674.9, 974.4, 672.3, 1003.7, 885.7, 1025, 493, 835.9, 1009.4, 396.5, 652, 502.3, 1100, 562.8, 1062.3, 1100, 950, 915.6, 400, 570, 630, 983.3, 542.4, 742.7, 1400, 491.2, 1300, 316.3, 476.8, 410.3, 499.5, 301.5, 343.8, 429.3, 398.1, 360.8, 398.2, 428.9, 608.9, 756.1, 292.4, 351.9, 496.6, 858.3, 761.8, 853.8, 984.4, 620.3, 633.4, 890.4, 929.5, 731.3, 428.5, 752.4, 428.2, 516.1, 701.5, 392.9, 424.1, 381.4, 568.9, 334.1, 518.9, 312.2, 354, 467.7, 366.3, 540.3, 613.3, 542.7, 480.2, 554.5, 586.1, 598.9, 667.5, 509.8, 487.6, 440.3, 386.6, 487.1, 424.3, 473.8, 387.4, 532, 1014.7, 551, 336.7, 653.7, 347.6, 322.6, 502.9, 603, 679.2, 522.5, 398.2, 332.3, 329.1, 399.1, 476, 592.6, 526.7, 465.6, 333.6, 613.3, 497.4, 606.6, 362.5, 357.4, 338.8, 331.4, 368.6, 421, 523.4, 249.6, 570.5, 492.2, 596.9, 542.1, 559.6, 615.6, 583, 564.3, 501.9, 408.6, 639.9, 726, 601.7, 529.3, 423.7, 410.2, 458.8, 303.5, 362.7, 518.8, 510.7, 775, 485.4, 458.6, 302.5, 588.2, 576.1, 583.6, 474, 542.7, 596, 677.5, 498.2, 560.9, 841.2, 881.8, 410, 408.8, 525.4, 652.7, 492.3, 587.8, 506.1, 467.1, 529.8, 615.9, 448.3, 399.1, 448.8, 662.8, 494.7, 331.8, 601.3, 489.6, 528.5, 432.5, 440.5, 545, 550.2, 538.9, 616.1, 565, 535, 872.2, 373.4, 416.4, 532.7, 482.9, 546.8, 607, 609.5, 557.3, 601.8, 542.9, 722.1, 454.1, 651.2, 594.9, 493.5, 488.2, 542.3, 500.9, 987.3, 239.3, 518.9, 456.1, 356.6, 608.8, 350.6, 407.3, 930.8, 454.6, 633.2, 270.7, 705, 402.4, 417, 611.7, 508.5, 428.9, 495.7, 485.9, 495.1, 576.1, 559.7, 518.1, 593.9, 472.4, 448.3, 607.7, 585.6, 390, 678.3, 450.4, 424.8, 586.7, 551.3, 400, 503.4, 586.9, 816, 563.9, 247.5, 886.5, 651.3, 499.6, 817.1, 917.6, 584.8, 400, 386, 929.3, 873.2, 586.9, 390, 999.4, 799.7, 846.6, 949.4, 552.7, 219.6, 761.4, 775.6, 817.3, 591.6, 939.4, 851.4, 924.5, 938.8, 400, 659.5, 296.2, 576.1, 533.8, 510.7, 473.9, 609.8, 317.5, 410, 664.3, 530.5, 483.8, 350.5, 358.3, 1038.9, 920, 878, 405.9, 710.7, 833.3, 994.5, 406.3, 468.4, 349.4, 970, 1049.4, 359.9, 371.9, 610.4, 972.9, 948.4, 715.4, 820.4, 900, 710.3, 594.5, 419.5, 454.9, 568, 564.5, 834.6, 339, 319.2, 686.5, 632.3, 543.8, 694.8, 381.1, 384.4, 416.6, 501.4, 449, 588.1, 505.1, 433.6, 419.3, 401.6, 385.8, 409.5, 449.4, 508.6, 378.3, 301.4, 286.3, 323.6, 315.5, 289.7, 669.1, 715.7, 413.9, 397.1, 415.6, 673.2, 298, 322.4, 318.8, 301.1, 301.9, 403.6, 397.4, 485.2, 307.6, 355.8, 255.5, 263.5, 416.5, 452.5, 526.3, 341, 666.7, 277.4, 190.3, 529.4, 364.9, 244.4, 183.8, 435.4, 459, 525.1, 379.3, 362.3, 339.4, 173, 269, 518, 332.3, 162.4, 151.9, 191.6, 341.5, 374.1, 191.7, 213.3, 233, 233, 415.6, 255.6, 108.1, 950, 247.4, 363.7, 260.2, 291.9, 117.3, 191.9, 162.4, 126, 287.4, 150.2, 404.3, 269.2, 312.6, 177.1, 129.8, 269, 289.6, 230.3, 386.9, 165.8, 239.2, 348.3, 368.9, 128, 359.5, 203.8, 596.9, 218.7, 367.1, 355, 363.8, 226.7, 233.6, 296.7, 274.3, 151.1, 227, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 264.2, 268.7, 269.3, 269.3, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4, 269.4],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 361, 368.4, 370, 370.9, 371.8, 372.7, 373.5, 374.4, 375.2, 376.1, 376.9, 377.7, 378.5, 379.3, 380.1, 380.9, 381.7, 382.5, 383.3, 384.1, 384.8, 385.6, 386.4, 387.1, 387.9, 388.6, 389.4, 390.1, 390.8, 391.6, 392.3, 393, 393.7, 394.4, 395.1, 395.8, 396.5, 397.2, 397.9, 398.6, 399.3, 400, 400.7, 401.3, 402, 402.7, 403.3, 404, 404.6, 405.3],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 167.3, 169.1, 168.6, 167.7, 166.9, 166, 165.2, 164.3, 163.5, 162.6, 161.8, 161, 160.2, 159.4, 158.6, 157.8, 157, 156.2, 155.4, 154.6, 153.9, 153.1, 152.3, 151.6, 150.8, 150.1, 149.3, 148.6, 147.9, 147.1, 146.4, 145.7, 145, 144.3, 143.6, 142.9, 142.2, 141.5, 140.8, 140.1, 139.4, 138.7, 138, 137.4, 136.7, 136, 135.4, 134.7, 134.1, 133.4],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  竹筍
                **/
                $( "#a1_3" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart1_3')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '竹筍',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/2/24", "2015/6/6", "2015/6/7", "2015/6/9", "2015/6/11", "2015/6/16", "2015/6/18", "2015/6/19", "2015/6/20", "2015/6/23", "2015/6/24", "2015/6/25", "2015/6/26", "2015/6/27", "2015/6/28", "2015/6/30", "2015/7/1", "2015/7/2", "2015/7/3", "2015/7/4", "2015/7/5", "2015/7/7", "2015/7/8", "2015/7/9", "2015/7/10", "2015/7/11", "2015/7/12", "2015/7/14", "2015/7/15", "2015/7/16", "2015/7/17", "2015/7/18", "2015/7/19", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/24", "2015/7/25", "2015/7/26", "2015/7/28", "2015/7/29", "2015/7/30", "2015/7/31", "2015/8/1", "2015/8/2", "2015/8/4", "2015/8/5", "2015/8/6", "2015/8/7", "2015/8/8", "2015/8/9", "2015/8/11", "2015/8/12", "2015/8/13", "2015/8/14", "2015/8/15", "2015/8/16", "2015/8/18", "2015/8/19", "2015/8/20", "2015/8/21", "2015/8/22", "2015/8/23", "2015/8/25", "2015/8/27", "2015/8/28", "2015/9/1", "2015/9/2", "2015/9/3", "2015/9/4", "2015/9/5", "2015/9/6", "2015/9/8", "2015/9/9", "2015/9/10", "2015/9/11", "2015/9/12", "2015/9/13", "2015/9/15", "2015/9/16", "2015/9/17", "2015/9/18", "2015/9/19", "2015/9/20", "2015/9/22", "2015/9/23", "2015/9/24", "2015/9/25", "2015/9/26", "2015/9/27", "2015/9/30", "2015/10/1", "2015/10/2", "2015/10/3", "2015/10/4", "2015/10/6", "2015/10/7", "2015/10/8", "2015/10/9", "2015/10/10", "2015/10/11", "2015/10/13", "2015/10/14", "2015/10/15", "2015/10/18", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/30", "2015/11/3", "2015/11/7", "2015/11/11", "2015/11/15", "2016/3/29", "2016/5/17", "2016/5/20", "2016/5/21", "2016/5/22", "2016/5/24", "2016/5/25", "2016/5/28", "2016/5/31", "2016/6/1", "2016/6/2", "2016/6/3", "2016/6/4", "2016/6/5", "2016/6/7", "2016/6/8", "2016/6/9", "2016/6/15", "2016/6/16", "2016/6/17", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/23", "2016/6/24", "2016/6/25", "2016/6/26", "2016/6/28", "2016/6/29", "2016/6/30", "2016/7/1", "2016/7/2", "2016/7/3", "2016/7/5", "2016/7/6", "2016/7/7", "2016/7/8", "2016/7/9", "2016/7/10", "2016/7/12", "2016/7/13", "2016/7/14", "2016/7/15", "2016/7/16", "2016/7/17", "2016/7/19", "2016/7/20", "2016/7/21", "2016/7/22", "2016/7/23", "2016/7/24", "2016/7/26", "2016/7/27", "2016/7/28", "2016/7/29", "2016/7/30", "2016/7/31", "2016/8/2", "2016/8/3", "2016/8/4", "2016/8/5", "2016/8/6", "2016/8/7", "2016/8/9", "2016/8/10", "2016/8/11", "2016/8/12", "2016/8/13", "2016/8/14", "2016/8/16", "2016/8/17", "2016/8/20", "2016/8/21", "2016/8/23", "2016/8/24", "2016/8/25", "2016/8/26", "2016/8/27", "2016/8/28", "2016/8/30", "2016/8/31", "2016/9/1", "2016/9/2", "2016/9/3", "2016/9/4", "2016/9/6", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/10", "2016/9/11", "2016/9/13", "2016/9/14", "2016/9/15", "2016/9/18", "2016/9/20", "2016/9/21", "2016/9/22", "2016/9/23", "2016/9/24", "2016/9/25", "2016/9/27", "2016/9/28", "2016/9/29", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/12", "2016/10/13", "2016/11/16", "2017/2/4", "2017/6/14", "2017/6/15", "2017/6/16", "2017/6/17", "2017/6/18", "2017/6/20", "2017/6/22", "2017/6/23", "2017/6/25", "2017/6/27", "2017/6/28", "2017/6/29", "2017/6/30", "2017/7/1", "2017/7/2", "2017/7/4", "2017/7/5", "2017/7/6", "2017/7/7", "2017/7/8", "2017/7/9", "2017/7/11", "2017/7/12", "2017/7/13", "2017/7/14", "2017/7/15", "2017/7/16", "2017/7/18", "2017/7/19", "2017/7/20", "2017/7/21", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/27", "2017/7/28", "2017/7/29", "2017/7/30", "2017/8/1", "2017/8/2", "2017/8/3", "2017/8/4", "2017/8/5", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/12", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/17", "2017/8/18", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/26", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/1", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/8", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/14", "2017/9/15", "2017/9/16", "2017/9/17", "2017/9/19", "2017/9/20", "2017/9/21", "2017/9/22", "2017/9/23", "2017/9/24", "2017/9/26", "2017/9/27", "2017/9/28", "2017/9/29", "2017/9/30", "2017/10/1", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/14", "2017/10/15", "2017/10/17", "2017/10/18", "2017/10/19", "2017/10/24", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/5", "2017/11/7", "2017/11/9", "2017/11/15", "2017/11/16", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [10, 38, 39.1, 36.2, 36, 43, 46, 39.5, 39.6, 29.8, 16.5, 15.8, 20, 24.7, 22.7, 25.6, 22.6, 20.2, 20, 23, 34.5, 32.6, 26, 33.3, 26.6, 23.7, 17.7, 15.5, 16.5, 26.5, 21.2, 24.2, 22, 22.1, 24.4, 22, 25, 27.5, 25.5, 24, 26.2, 23.7, 25.5, 27.3, 22.8, 23.5, 23.3, 30.5, 27.1, 28, 24, 26.6, 27, 24.7, 30.8, 29.3, 30, 33, 31.3, 45, 40, 41, 34, 44, 67, 67.1, 45, 45, 38, 41.3, 50, 55, 45, 38.8, 37.6, 49, 51.3, 31.8, 41, 38, 33, 28.8, 26, 28.3, 29.6, 22.3, 18.5, 23, 25, 24.5, 30, 28.6, 24, 29.3, 32.8, 29.6, 33, 40, 20, 53, 48.3, 45, 60, 45, 46.3, 38.5, 27.5, 32.5, 30, 20, 20, 22, 25, 20, 18, 15, 20, 26, 48.7, 35, 41.2, 35, 30, 35, 30, 30, 30.5, 25, 22.5, 25, 40, 33, 40, 30, 23.5, 40.8, 31.6, 38, 34, 36.3, 37.8, 28.9, 32, 28.3, 25, 30.5, 26.9, 26, 26.1, 30, 29, 27, 28.3, 28.5, 31.5, 31.5, 28, 27.4, 26.7, 27.9, 29.3, 29.6, 30, 33, 34.4, 29.4, 27.3, 32.5, 33.6, 37.7, 37, 30.8, 38, 34, 27.3, 33.5, 37.3, 31.7, 37.6, 34.3, 30.6, 37.2, 37, 33, 34.8, 36.3, 42.3, 48.7, 46.8, 34.1, 38.2, 32, 25.3, 28, 28.1, 29.7, 30, 28.6, 25.8, 25.9, 23.3, 28.7, 25.2, 32, 24.3, 23.1, 21, 25.4, 25.3, 23.9, 26.1, 31.8, 25.3, 26.4, 21, 30.9, 31.3, 32.5, 33.8, 32.5, 37.5, 26.5, 38, 33.6, 31, 45.3, 41.7, 35.7, 60, 58, 47.5, 35, 22, 3, 45, 31.8, 35, 40, 43, 42, 40, 30, 46.7, 42.3, 38.6, 27, 34.3, 39.4, 42, 36.3, 34.2, 37, 34.5, 32.3, 35.8, 37.5, 33, 27.4, 31.3, 29.5, 31.8, 28.9, 28.3, 20.8, 32.8, 30.2, 31.5, 31.4, 30, 35, 45.8, 47.5, 36, 32.1, 32, 28.1, 32.7, 30.7, 37.2, 38, 35.8, 41.3, 43.5, 45, 43.3, 36.7, 37.7, 33.7, 37, 52.6, 30.6, 29.8, 33.6, 39.8, 37.5, 38.8, 40.2, 31, 33, 37.3, 37.8, 58.5, 44.2, 30.3, 55, 37.5, 38.1, 35.3, 51.3, 39.3, 32.7, 28.5, 50, 41.4, 33, 21.8, 35.5, 33, 52, 36.8, 33.4, 31.9, 25.2, 24.6, 22, 38, 29.8, 27.2, 38.8, 29.6, 35, 30, 20, 35, 30, 30, 25, 40, 25.6, 50, 54, 35, 50, 32, 40, 25, 35, 12, 24, 20, 10, 13, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 18.9, 21.5, 23.6, 25.2, 26.6, 27.7, 28.6, 29.3, 29.9, 30.3, 30.7, 31, 31.3, 31.5, 31.6, 31.8, 31.9, 32, 32, 32.1, 32.1, 32.2, 32.2, 32.2, 32.2, 32.2, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 22.6, 25.5, 27.8, 29.7, 31.1, 32.2, 33.2, 33.9, 34.5, 35, 35.4, 35.7, 35.9, 36.1, 36.3, 36.4, 36.5, 36.6, 36.7, 36.7, 36.8, 36.8, 36.8, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 15.2, 17.5, 19.3, 20.8, 22.1, 23.2, 24, 24.7, 25.3, 25.7, 26.1, 26.4, 26.6, 26.8, 27, 27.1, 27.2, 27.3, 27.4, 27.4, 27.5, 27.5, 27.5, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  白菜
                **/
                $( "#a1_4" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart1_4')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '白菜',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/2/24", "2015/6/6", "2015/6/7", "2015/6/9", "2015/6/11", "2015/6/16", "2015/6/18", "2015/6/19", "2015/6/20", "2015/6/23", "2015/6/24", "2015/6/25", "2015/6/26", "2015/6/27", "2015/6/28", "2015/6/30", "2015/7/1", "2015/7/2", "2015/7/3", "2015/7/4", "2015/7/5", "2015/7/7", "2015/7/8", "2015/7/9", "2015/7/10", "2015/7/11", "2015/7/12", "2015/7/14", "2015/7/15", "2015/7/16", "2015/7/17", "2015/7/18", "2015/7/19", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/24", "2015/7/25", "2015/7/26", "2015/7/28", "2015/7/29", "2015/7/30", "2015/7/31", "2015/8/1", "2015/8/2", "2015/8/4", "2015/8/5", "2015/8/6", "2015/8/7", "2015/8/8", "2015/8/9", "2015/8/11", "2015/8/12", "2015/8/13", "2015/8/14", "2015/8/15", "2015/8/16", "2015/8/18", "2015/8/19", "2015/8/20", "2015/8/21", "2015/8/22", "2015/8/23", "2015/8/25", "2015/8/27", "2015/8/28", "2015/9/1", "2015/9/2", "2015/9/3", "2015/9/4", "2015/9/5", "2015/9/6", "2015/9/8", "2015/9/9", "2015/9/10", "2015/9/11", "2015/9/12", "2015/9/13", "2015/9/15", "2015/9/16", "2015/9/17", "2015/9/18", "2015/9/19", "2015/9/20", "2015/9/22", "2015/9/23", "2015/9/24", "2015/9/25", "2015/9/26", "2015/9/27", "2015/9/30", "2015/10/1", "2015/10/2", "2015/10/3", "2015/10/4", "2015/10/6", "2015/10/7", "2015/10/8", "2015/10/9", "2015/10/10", "2015/10/11", "2015/10/13", "2015/10/14", "2015/10/15", "2015/10/18", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/30", "2015/11/3", "2015/11/7", "2015/11/11", "2015/11/15", "2016/3/29", "2016/5/17", "2016/5/20", "2016/5/21", "2016/5/22", "2016/5/24", "2016/5/25", "2016/5/28", "2016/5/31", "2016/6/1", "2016/6/2", "2016/6/3", "2016/6/4", "2016/6/5", "2016/6/7", "2016/6/8", "2016/6/9", "2016/6/15", "2016/6/16", "2016/6/17", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/23", "2016/6/24", "2016/6/25", "2016/6/26", "2016/6/28", "2016/6/29", "2016/6/30", "2016/7/1", "2016/7/2", "2016/7/3", "2016/7/5", "2016/7/6", "2016/7/7", "2016/7/8", "2016/7/9", "2016/7/10", "2016/7/12", "2016/7/13", "2016/7/14", "2016/7/15", "2016/7/16", "2016/7/17", "2016/7/19", "2016/7/20", "2016/7/21", "2016/7/22", "2016/7/23", "2016/7/24", "2016/7/26", "2016/7/27", "2016/7/28", "2016/7/29", "2016/7/30", "2016/7/31", "2016/8/2", "2016/8/3", "2016/8/4", "2016/8/5", "2016/8/6", "2016/8/7", "2016/8/9", "2016/8/10", "2016/8/11", "2016/8/12", "2016/8/13", "2016/8/14", "2016/8/16", "2016/8/17", "2016/8/20", "2016/8/21", "2016/8/23", "2016/8/24", "2016/8/25", "2016/8/26", "2016/8/27", "2016/8/28", "2016/8/30", "2016/8/31", "2016/9/1", "2016/9/2", "2016/9/3", "2016/9/4", "2016/9/6", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/10", "2016/9/11", "2016/9/13", "2016/9/14", "2016/9/15", "2016/9/18", "2016/9/20", "2016/9/21", "2016/9/22", "2016/9/23", "2016/9/24", "2016/9/25", "2016/9/27", "2016/9/28", "2016/9/29", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/12", "2016/10/13", "2016/11/16", "2017/2/4", "2017/6/14", "2017/6/15", "2017/6/16", "2017/6/17", "2017/6/18", "2017/6/20", "2017/6/22", "2017/6/23", "2017/6/25", "2017/6/27", "2017/6/28", "2017/6/29", "2017/6/30", "2017/7/1", "2017/7/2", "2017/7/4", "2017/7/5", "2017/7/6", "2017/7/7", "2017/7/8", "2017/7/9", "2017/7/11", "2017/7/12", "2017/7/13", "2017/7/14", "2017/7/15", "2017/7/16", "2017/7/18", "2017/7/19", "2017/7/20", "2017/7/21", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/27", "2017/7/28", "2017/7/29", "2017/7/30", "2017/8/1", "2017/8/2", "2017/8/3", "2017/8/4", "2017/8/5", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/12", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/17", "2017/8/18", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/26", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/1", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/8", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/14", "2017/9/15", "2017/9/16", "2017/9/17", "2017/9/19", "2017/9/20", "2017/9/21", "2017/9/22", "2017/9/23", "2017/9/24", "2017/9/26", "2017/9/27", "2017/9/28", "2017/9/29", "2017/9/30", "2017/10/1", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/14", "2017/10/15", "2017/10/17", "2017/10/18", "2017/10/19", "2017/10/24", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/5", "2017/11/7", "2017/11/9", "2017/11/15", "2017/11/16", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [10, 38, 39.1, 36.2, 36, 43, 46, 39.5, 39.6, 29.8, 16.5, 15.8, 20, 24.7, 22.7, 25.6, 22.6, 20.2, 20, 23, 34.5, 32.6, 26, 33.3, 26.6, 23.7, 17.7, 15.5, 16.5, 26.5, 21.2, 24.2, 22, 22.1, 24.4, 22, 25, 27.5, 25.5, 24, 26.2, 23.7, 25.5, 27.3, 22.8, 23.5, 23.3, 30.5, 27.1, 28, 24, 26.6, 27, 24.7, 30.8, 29.3, 30, 33, 31.3, 45, 40, 41, 34, 44, 67, 67.1, 45, 45, 38, 41.3, 50, 55, 45, 38.8, 37.6, 49, 51.3, 31.8, 41, 38, 33, 28.8, 26, 28.3, 29.6, 22.3, 18.5, 23, 25, 24.5, 30, 28.6, 24, 29.3, 32.8, 29.6, 33, 40, 20, 53, 48.3, 45, 60, 45, 46.3, 38.5, 27.5, 32.5, 30, 20, 20, 22, 25, 20, 18, 15, 20, 26, 48.7, 35, 41.2, 35, 30, 35, 30, 30, 30.5, 25, 22.5, 25, 40, 33, 40, 30, 23.5, 40.8, 31.6, 38, 34, 36.3, 37.8, 28.9, 32, 28.3, 25, 30.5, 26.9, 26, 26.1, 30, 29, 27, 28.3, 28.5, 31.5, 31.5, 28, 27.4, 26.7, 27.9, 29.3, 29.6, 30, 33, 34.4, 29.4, 27.3, 32.5, 33.6, 37.7, 37, 30.8, 38, 34, 27.3, 33.5, 37.3, 31.7, 37.6, 34.3, 30.6, 37.2, 37, 33, 34.8, 36.3, 42.3, 48.7, 46.8, 34.1, 38.2, 32, 25.3, 28, 28.1, 29.7, 30, 28.6, 25.8, 25.9, 23.3, 28.7, 25.2, 32, 24.3, 23.1, 21, 25.4, 25.3, 23.9, 26.1, 31.8, 25.3, 26.4, 21, 30.9, 31.3, 32.5, 33.8, 32.5, 37.5, 26.5, 38, 33.6, 31, 45.3, 41.7, 35.7, 60, 58, 47.5, 35, 22, 3, 45, 31.8, 35, 40, 43, 42, 40, 30, 46.7, 42.3, 38.6, 27, 34.3, 39.4, 42, 36.3, 34.2, 37, 34.5, 32.3, 35.8, 37.5, 33, 27.4, 31.3, 29.5, 31.8, 28.9, 28.3, 20.8, 32.8, 30.2, 31.5, 31.4, 30, 35, 45.8, 47.5, 36, 32.1, 32, 28.1, 32.7, 30.7, 37.2, 38, 35.8, 41.3, 43.5, 45, 43.3, 36.7, 37.7, 33.7, 37, 52.6, 30.6, 29.8, 33.6, 39.8, 37.5, 38.8, 40.2, 31, 33, 37.3, 37.8, 58.5, 44.2, 30.3, 55, 37.5, 38.1, 35.3, 51.3, 39.3, 32.7, 28.5, 50, 41.4, 33, 21.8, 35.5, 33, 52, 36.8, 33.4, 31.9, 25.2, 24.6, 22, 38, 29.8, 27.2, 38.8, 29.6, 35, 30, 20, 35, 30, 30, 25, 40, 25.6, 50, 54, 35, 50, 32, 40, 25, 35, 12, 24, 20, 10, 13, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 18.9, 21.5, 23.6, 25.2, 26.6, 27.7, 28.6, 29.3, 29.9, 30.3, 30.7, 31, 31.3, 31.5, 31.6, 31.8, 31.9, 32, 32, 32.1, 32.1, 32.2, 32.2, 32.2, 32.2, 32.2, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3, 32.3],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 22.6, 25.5, 27.8, 29.7, 31.1, 32.2, 33.2, 33.9, 34.5, 35, 35.4, 35.7, 35.9, 36.1, 36.3, 36.4, 36.5, 36.6, 36.7, 36.7, 36.8, 36.8, 36.8, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 36.9, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37, 37],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 15.2, 17.5, 19.3, 20.8, 22.1, 23.2, 24, 24.7, 25.3, 25.7, 26.1, 26.4, 26.6, 26.8, 27, 27.1, 27.2, 27.3, 27.4, 27.4, 27.5, 27.5, 27.5, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.6, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7, 27.7],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  木瓜
                **/
                $( "#a1_5" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart1_5')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '木瓜',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/2", "2015/1/3", "2015/1/4", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/14", "2015/1/15", "2015/1/18", "2015/1/20", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/5", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/16", "2015/2/18", "2015/2/24", "2015/2/25", "2015/2/26", "2015/2/28", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/10", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/18", "2015/3/19", "2015/3/21", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/15", "2015/4/16", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/22", "2015/4/23", "2015/4/24", "2015/4/25", "2015/4/26", "2015/4/28", "2015/4/29", "2015/4/30", "2015/5/2", "2015/5/3", "2015/5/5", "2015/5/7", "2015/5/8", "2015/5/9", "2015/5/10", "2015/5/12", "2015/5/13", "2015/5/14", "2015/5/15", "2015/5/17", "2015/5/19", "2015/5/20", "2015/5/21", "2015/5/23", "2015/5/24", "2015/5/26", "2015/5/27", "2015/5/28", "2015/5/29", "2015/5/30", "2015/5/31", "2015/6/2", "2015/6/3", "2015/6/4", "2015/6/5", "2015/6/7", "2015/6/9", "2015/6/10", "2015/6/11", "2015/6/13", "2015/6/16", "2015/6/18", "2015/6/24", "2015/6/26", "2015/6/30", "2015/7/2", "2015/7/5", "2015/7/7", "2015/7/11", "2015/7/12", "2015/7/17", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/29", "2015/8/2", "2015/8/12", "2015/9/6", "2015/9/8", "2015/9/10", "2015/9/13", "2015/9/16", "2015/9/17", "2015/9/18", "2015/9/19", "2015/9/30", "2015/10/2", "2015/10/3", "2015/10/4", "2015/10/11", "2015/10/17", "2015/10/18", "2015/10/20", "2015/10/22", "2015/10/24", "2015/10/25", "2015/10/28", "2015/10/29", "2015/10/30", "2015/11/1", "2015/11/3", "2015/11/6", "2015/11/7", "2015/11/12", "2015/11/15", "2015/11/17", "2015/11/20", "2015/11/24", "2015/11/26", "2015/11/27", "2015/11/29", "2015/12/2", "2015/12/3", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/10", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/18", "2015/12/22", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/29", "2016/1/10", "2016/1/12", "2016/1/13", "2016/2/6", "2016/2/7", "2016/2/17", "2016/3/4", "2016/3/6", "2016/3/13", "2016/3/20", "2016/4/9", "2016/4/14", "2016/4/15", "2016/4/19", "2016/4/20", "2016/4/23", "2016/4/24", "2016/4/27", "2016/4/29", "2016/4/30", "2016/5/5", "2016/5/6", "2016/5/10", "2016/5/12", "2016/5/14", "2016/5/21", "2016/5/24", "2016/5/25", "2016/5/27", "2016/8/26", "2016/8/30", "2016/8/31", "2016/9/1", "2016/9/3", "2016/9/4", "2016/9/6", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/10", "2016/9/11", "2016/9/13", "2016/9/20", "2016/9/21", "2016/9/23", "2016/9/24", "2016/9/25", "2016/9/27", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/6", "2016/10/7", "2016/10/9", "2016/10/12", "2016/10/14", "2016/10/21", "2016/10/22", "2016/10/23", "2016/10/28", "2016/10/29", "2016/10/30", "2016/11/1", "2016/11/2", "2016/11/3", "2016/11/4", "2016/11/5", "2016/11/6", "2016/11/9", "2016/11/10", "2016/11/11", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/17", "2016/11/18", "2016/11/19", "2016/11/22", "2016/11/25", "2016/11/26", "2016/11/27", "2016/11/29", "2016/11/30", "2016/12/1", "2016/12/2", "2016/12/3", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/10", "2016/12/11", "2016/12/15", "2016/12/16", "2016/12/17", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/25", "2016/12/27", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/13", "2017/1/14", "2017/1/15", "2017/1/18", "2017/1/19", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/2/2", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/21", "2017/2/23", "2017/2/24", "2017/2/25", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/4", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/3", "2017/4/6", "2017/4/7", "2017/4/8", "2017/4/9", "2017/4/11", "2017/4/12", "2017/4/13", "2017/4/15", "2017/4/18", "2017/4/19", "2017/4/20", "2017/4/21", "2017/4/22", "2017/4/23", "2017/4/25", "2017/4/26", "2017/4/27", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/3", "2017/5/4", "2017/5/5", "2017/5/7", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/16", "2017/5/17", "2017/5/18", "2017/5/19", "2017/5/23", "2017/5/24", "2017/5/25", "2017/5/26", "2017/5/27", "2017/5/29", "2017/5/30", "2017/6/2", "2017/6/3", "2017/6/4", "2017/6/7", "2017/6/8", "2017/6/9", "2017/6/10", "2017/6/11", "2017/6/13", "2017/6/14", "2017/6/15", "2017/6/22", "2017/6/24", "2017/6/27", "2017/6/29", "2017/7/1", "2017/7/5", "2017/7/6", "2017/7/8", "2017/7/11", "2017/7/12", "2017/7/13", "2017/7/15", "2017/7/18", "2017/7/19", "2017/7/20", "2017/7/26", "2017/7/27", "2017/8/2", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/12", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/25", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/15", "2017/9/17", "2017/9/19", "2017/9/21", "2017/9/23", "2017/9/24", "2017/9/26", "2017/9/27", "2017/9/28", "2017/9/29", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/15", "2017/10/20", "2017/10/21", "2017/10/22", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13", "2018/1/14"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [10, 10, 10, 20, 15, 15, 6, 13, 10.8, 6, 8, 10, 8, 8.7, 9.3, 6, 10.4, 6.8, 6.6, 5, 4.9, 5, 5, 5, 8, 6, 7, 5, 11.5, 6, 7.6, 3, 3, 3, 3, 4.2, 3, 8, 3, 3.2, 3, 4, 5.9, 10, 5, 5, 5, 5, 8, 2, 5, 5, 3, 3, 17, 8, 11.5, 8, 9.4, 3, 6, 6, 5, 3, 3, 3, 8, 5, 8, 3, 3, 3, 7, 8, 3, 3, 7.4, 3, 3, 3.8, 2, 2, 2, 2, 2, 2, 5, 2, 2, 1, 2, 5, 2, 1, 1, 3.5, 5, 1, 5, 1, 7, 1, 3.2, 4.8, 2, 4, 1, 1, 5, 4, 2, 1, 1, 30, 35, 10, 16.9, 20, 12.4, 20, 27, 26.6, 17.6, 28.2, 39, 20, 20, 20, 20, 20, 28, 25, 25, 30, 18, 20, 20, 20, 13, 30, 20, 44.3, 20, 40, 28, 25, 40, 20, 35, 25, 35, 21.3, 18.4, 18, 15, 29.7, 15, 17.9, 12, 20, 15, 22, 10, 14, 6, 12, 10, 5, 2, 2, 5, 3, 9.7, 17.7, 10, 5, 8, 3, 10, 14.2, 17, 7, 4, 11.4, 17, 6, 4, 8.3, 12, 16.6, 18, 22, 8, 14.7, 8, 10, 10, 5, 18, 15, 18, 20, 10, 8, 10, 25.5, 8, 15, 5, 5, 20, 15, 13, 35, 20.8, 10, 5, 12, 27, 15, 15, 30, 25, 35, 35, 39.6, 55, 25, 45, 35, 41.9, 15, 35, 38.4, 35, 28.9, 20, 40, 36.3, 42.8, 47, 47.2, 54.8, 40, 53.3, 49.6, 63.8, 60, 48, 35, 53, 15, 51.5, 45, 47.6, 50, 35, 65, 10, 35, 55, 65, 72.2, 46.6, 80, 35, 87, 42, 42, 60, 77.6, 70, 40, 20, 63, 20, 62.6, 35, 35, 41.7, 30.3, 30, 47.1, 10, 8, 20, 32.1, 37.8, 36.3, 24, 43.7, 20, 40, 50, 44.4, 42, 18, 41.3, 46.1, 43.4, 27.6, 52.7, 22, 40, 50.3, 52, 40.9, 32, 25, 41, 44.8, 15, 45.7, 48.4, 35.1, 12, 25.7, 36.2, 39.8, 20, 8, 22.8, 31, 37.4, 15, 59.4, 37, 61.3, 35.9, 15, 16.7, 64.7, 40, 58.7, 27.3, 15, 63.1, 49.8, 29.5, 42.3, 40.8, 37.2, 10, 64.3, 63.6, 55.3, 53, 35, 32, 47.9, 45.3, 40.7, 15, 48, 53.7, 45, 61.6, 44.9, 15, 33.1, 43.1, 15, 37.8, 33.8, 28.8, 30.3, 38.7, 38.7, 41.9, 25, 23.9, 22.3, 22, 27, 5, 5, 29.3, 20.1, 27.7, 6, 5, 8.5, 27.6, 33, 10, 28, 39.4, 15, 15, 42, 8, 7, 12.5, 10, 5, 15, 27.7, 15, 5, 20, 34.1, 22.8, 25.5, 18, 35, 18, 7, 20.5, 8, 30.3, 15, 25.4, 19.4, 18, 20.8, 15, 15, 31, 26.3, 22, 13, 24.6, 12, 5, 5, 25, 13.6, 10, 7, 10, 5, 10, 6, 20.3, 14.8, 9, 10, 14.7, 10, 7, 5, 3, 13.7, 7.8, 11, 11.7, 21.1, 27, 17.6, 15, 25.9, 30, 24.9, 17.9, 27, 15, 24.6, 33.5, 16.3, 25, 26, 33.9, 18.5, 22.6, 17, 29, 33.7, 20, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6, 24.6],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 30, 30.1, 30.2, 30.3, 30.4, 30.6, 30.7, 30.8, 30.9, 31, 31.1, 31.2, 31.3, 31.4, 31.5, 31.5, 31.6, 31.7, 31.8, 31.9, 32, 32.1, 32.2, 32.2, 32.3, 32.4, 32.5, 32.6, 32.7, 32.7, 32.8, 32.9, 33, 33, 33.1, 33.2, 33.3, 33.3, 33.4, 33.5, 33.6, 33.6, 33.7, 33.8, 33.8, 33.9, 34, 34, 34.1, 34.2],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 19.3, 19.2, 19.1, 19, 18.9, 18.7, 18.6, 18.5, 18.4, 18.3, 18.2, 18.1, 18, 17.9, 17.8, 17.8, 17.7, 17.6, 17.5, 17.4, 17.3, 17.2, 17.1, 17, 17, 16.9, 16.8, 16.7, 16.6, 16.6, 16.5, 16.4, 16.3, 16.3, 16.2, 16.1, 16, 16, 15.9, 15.8, 15.7, 15.7, 15.6, 15.5, 15.5, 15.4, 15.3, 15.3, 15.2, 15.1],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  香蕉
                **/
                $( "#a1_6" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart1_6')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '香蕉',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/8/13", "2016/3/2", "2016/4/9", "2016/4/26", "2016/4/29", "2016/5/7", "2016/5/11", "2016/5/14", "2016/5/18", "2016/5/21", "2016/5/27", "2016/5/29", "2016/6/2", "2016/6/3", "2016/6/5", "2016/6/8", "2016/6/9", "2016/6/14", "2016/6/16", "2016/6/17", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/24", "2016/6/25", "2016/7/2", "2016/7/3", "2016/7/6", "2016/7/12", "2016/7/16", "2016/7/17", "2016/7/19", "2016/7/22", "2016/7/29", "2016/7/30", "2016/8/2", "2016/8/10", "2016/8/13", "2016/8/17", "2016/8/20", "2016/8/21", "2016/8/26", "2016/8/27", "2016/8/30", "2016/9/1", "2016/9/2", "2016/9/3", "2016/9/6", "2016/9/13", "2016/9/14", "2016/9/15", "2016/9/20", "2016/9/21", "2016/9/24", "2016/9/27", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/9", "2016/10/11", "2016/10/12", "2016/10/13", "2016/10/14", "2016/10/15", "2016/10/16", "2016/10/19", "2016/10/23", "2016/10/26", "2016/10/28", "2016/11/1", "2016/11/2", "2016/11/4", "2016/11/5", "2016/11/6", "2016/11/9", "2016/11/10", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/24", "2016/12/13", "2016/12/25", "2017/2/24", "2017/3/24", "2017/4/2", "2017/4/8", "2017/4/12", "2017/4/14", "2017/4/28", "2017/5/10", "2017/5/17", "2017/5/19", "2017/6/27", "2017/7/1", "2017/7/5", "2017/7/6", "2017/7/12", "2017/7/19", "2017/7/20", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/28", "2017/7/29", "2017/7/30", "2017/8/2", "2017/8/4", "2017/8/6", "2017/8/8", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/29", "2017/8/31", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/8", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/14", "2017/9/15", "2017/9/16", "2017/9/17", "2017/9/19", "2017/9/20", "2017/9/21", "2017/9/23", "2017/9/27", "2017/9/28", "2017/9/29", "2017/9/30", "2017/10/1", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/14", "2017/10/15", "2017/10/18", "2017/10/19", "2017/10/20", "2017/10/22", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/31", "2017/11/1", "2017/11/2", "2017/11/3", "2017/11/4", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/12", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [28, 32, 25, 25, 25, 26, 25, 25.8, 25, 18.8, 21, 20, 28.7, 21, 22, 27.5, 20, 12, 13, 12, 25, 20, 11, 13.2, 15, 15.6, 22, 20, 14, 11.5, 16.7, 13, 27, 17, 13.5, 15, 23, 17, 17, 18.5, 17, 18.3, 18, 21.7, 22, 21.5, 30, 19, 18, 19.3, 21, 22, 14.5, 23, 26.8, 18, 22, 25, 22.3, 25.5, 20, 16.3, 15.5, 32, 17.7, 20, 12.5, 12.5, 12.5, 10.5, 11.2, 15, 20, 23, 21, 18.2, 13.3, 17, 17.8, 25, 10, 21, 13.5, 15, 17, 14, 32.5, 30, 30, 30, 9, 31.5, 20, 25, 80.5, 52, 40, 30, 23.9, 16, 18, 19.4, 10, 11, 9.3, 12, 10, 15, 10.3, 15, 11.7, 8, 10, 8, 10, 12.5, 16, 9, 9.5, 12.3, 9.5, 9.4, 9.5, 13, 6, 10, 10.5, 10, 7.5, 11.5, 6.5, 6.2, 6.8, 8.3, 5, 8.9, 6.2, 5.3, 6, 4, 7.6, 11.4, 7, 9.1, 9.7, 9.2, 12, 10.6, 9.6, 6, 4.9, 6.3, 3, 4, 4.6, 5, 3.2, 4, 8.3, 11, 5, 7.9, 6.3, 8.6, 4.4, 7.2, 11.1, 9.7, 6.3, 9.4, 7, 6.1, 9.9, 8.8, 13.6, 7.2, 7.7, 16, 10.5, 7.7, 11.7, 8, 7.9, 8.7, 6.2, 6.3, 9.3, 10, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 9.2, 9.2, 9.1, 8.9, 8.9, 8.8, 8.8, 8.8, 8.8, 8.8, 8.8, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7, 8.7],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 12.3, 12.8, 12.8, 12.9, 13, 13, 13, 13.1, 13.1, 13.1, 13.2, 13.2, 13.2, 13.2, 13.3, 13.3, 13.3, 13.4, 13.4, 13.4, 13.4, 13.5, 13.5, 13.5, 13.6, 13.6, 13.6, 13.6, 13.7, 13.7, 13.7, 13.7, 13.8, 13.8, 13.8, 13.8, 13.9, 13.9, 13.9, 14, 14, 14, 14, 14.1, 14.1, 14.1, 14.1, 14.1, 14.2, 14.2],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 6, 5.7, 5.3, 5, 4.9, 4.7, 4.6, 4.5, 4.4, 4.4, 4.3, 4.3, 4.3, 4.2, 4.2, 4.2, 4.1, 4.1, 4.1, 4, 4, 4, 4, 3.9, 3.9, 3.9, 3.8, 3.8, 3.8, 3.8, 3.7, 3.7, 3.7, 3.7, 3.6, 3.6, 3.6, 3.6, 3.5, 3.5, 3.5, 3.5, 3.4, 3.4, 3.4, 3.4, 3.3, 3.3, 3.3, 3.3],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  土魠
                **/
                $( "#a2_1" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart2_1')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '土魠',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/2", "2015/1/3", "2015/1/4", "2015/1/6", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/10", "2015/1/11", "2015/1/13", "2015/1/14", "2015/1/15", "2015/1/16", "2015/1/17", "2015/1/18", "2015/1/20", "2015/1/21", "2015/1/22", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/28", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/5", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/15", "2015/2/16", "2015/2/17", "2015/2/18", "2015/2/25", "2015/2/26", "2015/2/27", "2015/2/28", "2015/3/1", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/10", "2015/3/11", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/15", "2015/3/17", "2015/3/18", "2015/3/19", "2015/3/20", "2015/3/21", "2015/3/22", "2015/3/24", "2015/3/25", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/5", "2015/4/11", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/16", "2015/4/17", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/22", "2015/4/23", "2015/4/24", "2015/4/25", "2015/4/26", "2015/4/28", "2015/4/29", "2015/4/30", "2015/5/1", "2015/5/2", "2015/5/3", "2015/5/5", "2015/5/6", "2015/5/7", "2015/5/8", "2015/5/9", "2015/5/10", "2015/5/12", "2015/5/13", "2015/5/14", "2015/5/15", "2015/5/16", "2015/5/17", "2015/5/19", "2015/5/20", "2015/5/21", "2015/5/22", "2015/5/23", "2015/5/24", "2015/5/26", "2015/5/27", "2015/5/28", "2015/5/29", "2015/5/30", "2015/5/31", "2015/6/2", "2015/6/3", "2015/6/4", "2015/6/5", "2015/6/6", "2015/6/7", "2015/6/9", "2015/6/10", "2015/6/11", "2015/6/12", "2015/6/13", "2015/6/14", "2015/6/16", "2015/6/17", "2015/6/18", "2015/6/19", "2015/6/20", "2015/6/23", "2015/6/24", "2015/6/25", "2015/6/26", "2015/6/27", "2015/6/28", "2015/6/30", "2015/7/1", "2015/7/2", "2015/7/3", "2015/7/4", "2015/7/5", "2015/7/7", "2015/7/8", "2015/7/9", "2015/7/10", "2015/7/11", "2015/7/12", "2015/7/14", "2015/7/15", "2015/7/16", "2015/7/17", "2015/7/18", "2015/7/19", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/24", "2015/7/25", "2015/7/26", "2015/7/28", "2015/7/29", "2015/7/30", "2015/7/31", "2015/8/1", "2015/8/2", "2015/8/4", "2015/8/5", "2015/8/6", "2015/8/7", "2015/8/8", "2015/8/9", "2015/8/11", "2015/8/12", "2015/8/13", "2015/8/14", "2015/8/15", "2015/8/16", "2015/8/18", "2015/8/19", "2015/8/20", "2015/8/21", "2015/8/22", "2015/8/23", "2015/8/25", "2015/8/26", "2015/8/27", "2015/8/28", "2015/9/1", "2015/9/2", "2015/9/3", "2015/9/4", "2015/9/5", "2015/9/6", "2015/9/8", "2015/9/9", "2015/9/10", "2015/9/11", "2015/9/12", "2015/9/13", "2015/9/15", "2015/9/16", "2015/9/17", "2015/9/18", "2015/9/19", "2015/9/20", "2015/9/22", "2015/9/23", "2015/9/24", "2015/9/25", "2015/9/26", "2015/9/27", "2015/10/1", "2015/10/2", "2015/10/3", "2015/10/4", "2015/10/6", "2015/10/7", "2015/10/8", "2015/10/9", "2015/10/10", "2015/10/11", "2015/10/13", "2015/10/14", "2015/10/15", "2015/10/16", "2015/10/17", "2015/10/18", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/24", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/29", "2015/10/30", "2015/10/31", "2015/11/1", "2015/11/3", "2015/11/4", "2015/11/5", "2015/11/6", "2015/11/7", "2015/11/8", "2015/11/10", "2015/11/11", "2015/11/12", "2015/11/13", "2015/11/14", "2015/11/15", "2015/11/17", "2015/11/18", "2015/11/19", "2015/11/20", "2015/11/21", "2015/11/22", "2015/11/24", "2015/11/26", "2015/11/27", "2015/11/28", "2015/11/29", "2015/12/1", "2015/12/2", "2015/12/3", "2015/12/4", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/9", "2015/12/10", "2015/12/11", "2015/12/12", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/17", "2015/12/18", "2015/12/19", "2015/12/20", "2015/12/22", "2015/12/23", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/27", "2015/12/29", "2015/12/30", "2015/12/31", "2016/1/1", "2016/1/2", "2016/1/3", "2016/1/5", "2016/1/6", "2016/1/7", "2016/1/8", "2016/1/9", "2016/1/10", "2016/1/12", "2016/1/13", "2016/1/14", "2016/1/15", "2016/1/16", "2016/1/17", "2016/1/19", "2016/1/20", "2016/1/21", "2016/1/22", "2016/1/23", "2016/1/24", "2016/1/26", "2016/1/27", "2016/1/28", "2016/1/29", "2016/1/30", "2016/1/31", "2016/2/2", "2016/2/3", "2016/2/4", "2016/2/5", "2016/2/6", "2016/2/7", "2016/2/16", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/21", "2016/2/24", "2016/2/25", "2016/2/26", "2016/2/27", "2016/2/28", "2016/3/1", "2016/3/2", "2016/3/3", "2016/3/4", "2016/3/5", "2016/3/6", "2016/3/8", "2016/3/9", "2016/3/10", "2016/3/11", "2016/3/12", "2016/3/13", "2016/3/15", "2016/3/16", "2016/3/17", "2016/3/18", "2016/3/19", "2016/3/20", "2016/3/22", "2016/3/23", "2016/3/24", "2016/3/25", "2016/3/26", "2016/3/27", "2016/3/29", "2016/3/30", "2016/3/31", "2016/4/1", "2016/4/2", "2016/4/3", "2016/4/10", "2016/4/12", "2016/4/13", "2016/4/14", "2016/4/15", "2016/4/16", "2016/4/17", "2016/4/19", "2016/4/20", "2016/4/21", "2016/4/22", "2016/4/23", "2016/4/24", "2016/4/26", "2016/4/28", "2016/4/29", "2016/4/30", "2016/5/1", "2016/5/3", "2016/5/4", "2016/5/5", "2016/5/6", "2016/5/7", "2016/5/8", "2016/5/10", "2016/5/11", "2016/5/12", "2016/5/13", "2016/5/14", "2016/5/15", "2016/5/17", "2016/5/18", "2016/5/19", "2016/5/20", "2016/5/21", "2016/5/22", "2016/5/24", "2016/5/25", "2016/5/26", "2016/5/27", "2016/5/28", "2016/5/29", "2016/5/31", "2016/6/1", "2016/6/2", "2016/6/3", "2016/6/4", "2016/6/5", "2016/6/7", "2016/6/8", "2016/6/9", "2016/6/12", "2016/6/14", "2016/6/15", "2016/6/16", "2016/6/17", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/23", "2016/6/24", "2016/6/25", "2016/6/26", "2016/6/28", "2016/6/29", "2016/6/30", "2016/7/2", "2016/7/3", "2016/7/5", "2016/7/6", "2016/7/7", "2016/7/9", "2016/7/12", "2016/7/13", "2016/7/14", "2016/7/15", "2016/7/16", "2016/7/17", "2016/7/19", "2016/7/20", "2016/7/21", "2016/7/22", "2016/7/24", "2016/7/26", "2016/7/27", "2016/7/28", "2016/7/29", "2016/7/30", "2016/7/31", "2016/8/2", "2016/8/3", "2016/8/4", "2016/8/5", "2016/8/6", "2016/8/7", "2016/8/9", "2016/8/10", "2016/8/11", "2016/8/12", "2016/8/13", "2016/8/14", "2016/8/16", "2016/8/17", "2016/8/20", "2016/8/21", "2016/8/23", "2016/8/24", "2016/8/25", "2016/8/26", "2016/8/27", "2016/8/28", "2016/8/30", "2016/8/31", "2016/9/1", "2016/9/2", "2016/9/3", "2016/9/4", "2016/9/6", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/10", "2016/9/11", "2016/9/13", "2016/9/14", "2016/9/15", "2016/9/16", "2016/9/17", "2016/9/21", "2016/9/22", "2016/9/23", "2016/9/24", "2016/9/25", "2016/9/27", "2016/9/29", "2016/9/30", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/9", "2016/10/11", "2016/10/12", "2016/10/13", "2016/10/14", "2016/10/15", "2016/10/16", "2016/10/18", "2016/10/19", "2016/10/20", "2016/10/21", "2016/10/22", "2016/10/23", "2016/10/25", "2016/10/26", "2016/10/27", "2016/10/28", "2016/10/29", "2016/10/30", "2016/11/1", "2016/11/2", "2016/11/3", "2016/11/4", "2016/11/5", "2016/11/6", "2016/11/8", "2016/11/9", "2016/11/10", "2016/11/11", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/16", "2016/11/17", "2016/11/18", "2016/11/19", "2016/11/20", "2016/11/22", "2016/11/23", "2016/11/24", "2016/11/25", "2016/11/26", "2016/11/27", "2016/11/29", "2016/11/30", "2016/12/1", "2016/12/2", "2016/12/3", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/8", "2016/12/9", "2016/12/10", "2016/12/11", "2016/12/13", "2016/12/14", "2016/12/16", "2016/12/17", "2016/12/18", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/24", "2016/12/25", "2016/12/28", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/3", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/11", "2017/1/12", "2017/1/14", "2017/1/15", "2017/1/17", "2017/1/19", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/1/26", "2017/1/27", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/15", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/19", "2017/2/21", "2017/2/22", "2017/2/23", "2017/2/24", "2017/2/25", "2017/2/26", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/3", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/4", "2017/4/11", "2017/4/12", "2017/4/13", "2017/4/14", "2017/4/15", "2017/4/19", "2017/4/20", "2017/4/22", "2017/4/23", "2017/4/25", "2017/4/26", "2017/4/27", "2017/4/28", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/3", "2017/5/4", "2017/5/5", "2017/5/6", "2017/5/7", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/16", "2017/5/17", "2017/5/18", "2017/5/19", "2017/5/20", "2017/5/21", "2017/5/23", "2017/5/24", "2017/5/25", "2017/5/26", "2017/5/27", "2017/5/28", "2017/5/30", "2017/6/2", "2017/6/3", "2017/6/6", "2017/6/10", "2017/6/11", "2017/6/13", "2017/6/14", "2017/6/15", "2017/6/16", "2017/6/17", "2017/6/21", "2017/6/22", "2017/6/24", "2017/6/25", "2017/6/27", "2017/6/28", "2017/6/29", "2017/6/30", "2017/7/1", "2017/7/2", "2017/7/4", "2017/7/5", "2017/7/7", "2017/7/8", "2017/7/9", "2017/7/11", "2017/7/12", "2017/7/13", "2017/7/14", "2017/7/15", "2017/7/16", "2017/7/18", "2017/7/21", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/27", "2017/7/28", "2017/7/29", "2017/8/1", "2017/8/2", "2017/8/3", "2017/8/5", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/12", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/17", "2017/8/18", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/26", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/1", "2017/9/2", "2017/9/3", "2017/9/4", "2017/9/5", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/14", "2017/9/15", "2017/9/16", "2017/9/17", "2017/9/19", "2017/9/20", "2017/9/21", "2017/9/22", "2017/9/23", "2017/9/24", "2017/9/26", "2017/9/27", "2017/9/28", "2017/9/29", "2017/9/30", "2017/10/1", "2017/10/3", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/15", "2017/10/17", "2017/10/18", "2017/10/19", "2017/10/20", "2017/10/21", "2017/10/22", "2017/10/24", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/1", "2017/11/2", "2017/11/3", "2017/11/4", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/12", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/20", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [392.1, 352.6, 324.5, 419.2, 399.7, 447, 332.5, 330.7, 345.4, 340, 376, 365.8, 310.7, 316.4, 460.5, 370.7, 362, 325.1, 379.5, 359.2, 419.6, 394.3, 418.3, 386.3, 371.8, 399.9, 374.5, 372.9, 415.3, 268.2, 303.4, 380, 474.4, 462.2, 417.5, 416.6, 478.2, 434.5, 398.1, 364.8, 427.5, 453.7, 451.7, 320.5, 276.3, 271.1, 297.9, 372.8, 332.2, 302.8, 352.5, 343.7, 339.7, 344.7, 302.2, 338.2, 376.3, 339.5, 347.9, 295.4, 295.4, 254.3, 255.8, 228.4, 218.5, 300.4, 282.4, 249.6, 285.9, 239.5, 232, 230.6, 272.5, 313.9, 264.9, 364.9, 427.2, 317.1, 343.3, 318.4, 263.3, 295.3, 234.4, 224.5, 217.8, 234.4, 246.2, 262.5, 240.9, 298.5, 296.3, 335.6, 254.7, 309.8, 229.5, 260.6, 263.8, 260.7, 249.8, 319.9, 340, 264.7, 249.9, 272.2, 261, 267.3, 294.7, 263.5, 238.4, 219.8, 244.2, 259.8, 275.4, 318, 256.8, 305.6, 332.7, 298.9, 281, 299.2, 290.9, 288.1, 282.7, 295.7, 288.6, 275.9, 250.2, 289.3, 290, 302.1, 279.8, 275.3, 292.7, 280.4, 283, 300.6, 249.3, 283.1, 282.3, 252.5, 319.3, 281.3, 280.8, 282.9, 262.3, 278.1, 307.8, 289, 281.5, 367, 375.1, 381, 310.4, 316.7, 304.2, 313.7, 242, 299.4, 302.2, 260.3, 291.6, 332.4, 332.3, 397.6, 360.1, 372.2, 323.5, 339.6, 339.5, 312.9, 368.4, 372, 275.1, 286.4, 338.8, 300.2, 260.1, 348.2, 299.1, 365.2, 336, 260.3, 352.3, 387.1, 347.2, 314, 238.1, 325.8, 284.2, 274.1, 293, 252.8, 320.9, 334.7, 281.7, 351, 297.1, 289.5, 343.4, 325.2, 252.8, 243.2, 222.4, 269.8, 255.8, 226.8, 250.6, 195.7, 352.6, 281.6, 356.8, 298.7, 254.2, 229.6, 226.4, 260.3, 211.9, 265.9, 265.3, 345.4, 292.9, 355.7, 292, 282.4, 417.2, 379.7, 296, 334.7, 243.5, 239, 324.4, 331.5, 339, 297, 262.4, 215.3, 195.7, 192.8, 343.1, 300, 359.8, 359.7, 359.6, 349.9, 340.1, 285.4, 319.7, 308.9, 420, 349.7, 336.4, 369.6, 360.5, 233.7, 177.5, 182.6, 258.7, 315.7, 330.6, 301, 327.7, 274.9, 238, 221.7, 188.8, 413.3, 407.3, 318.9, 276.9, 326.6, 254.2, 282.4, 373.1, 333.3, 288.9, 262.1, 355.4, 366.4, 281.7, 270.5, 306.3, 329.8, 303.3, 296, 253.6, 292.3, 317.5, 246.2, 380.7, 325.1, 284.7, 272.1, 274.6, 296.2, 297.2, 200, 255.6, 244.1, 422.5, 331.1, 317.9, 302.2, 274.6, 283.2, 337.5, 298.1, 188, 300.1, 322.8, 274.5, 353, 333.2, 349, 355.1, 350.2, 344.2, 335.4, 331.3, 403.7, 450.9, 346.9, 385.5, 430, 510.7, 524.1, 574.5, 653, 502.3, 446.1, 376.9, 305.2, 288.5, 295, 311.3, 354.4, 346.5, 358.8, 379.2, 408.5, 405.7, 400.7, 378.4, 323.8, 345.3, 356.5, 420.6, 371.7, 362.3, 306.7, 290.2, 315.8, 318.3, 374.3, 348.3, 263.2, 319.6, 367.1, 322, 347.3, 308.9, 280.6, 265.3, 405.4, 421.4, 329.2, 411.6, 384.3, 407.6, 432.8, 324.7, 375.7, 313.3, 363.9, 289.8, 283.2, 280.6, 301.5, 345.7, 285.1, 261.5, 322.7, 333.7, 398.8, 318.4, 265.1, 353.5, 327.5, 411.5, 338.7, 326.8, 369.6, 377.1, 321.6, 303, 255.9, 239.7, 265.6, 263.3, 280.4, 288, 326.8, 376.7, 324.8, 317.3, 383.6, 410.4, 357.5, 354.2, 371.3, 302.1, 310.7, 333.9, 369.9, 303.1, 362.5, 351.8, 323, 352.1, 348.9, 386.6, 378.8, 295.6, 342.2, 358.2, 342.1, 350.4, 402.7, 415.2, 326, 315.2, 227.1, 316.4, 342.8, 356.8, 323.8, 349.4, 343.6, 375.9, 399.8, 333.9, 301.9, 277.1, 415.1, 422.6, 375.5, 436.2, 354.1, 397.3, 382.3, 351.1, 383.5, 410.3, 385.4, 301.3, 371, 382.9, 423.2, 377.9, 437.9, 392, 433.1, 430.8, 330.3, 413.8, 427.2, 368.1, 328.5, 329.6, 297.4, 258.8, 339.9, 329.3, 322.2, 363.2, 309.9, 497.6, 374.7, 370.2, 327.2, 255.9, 305.7, 331.4, 311.3, 362.2, 397.9, 347.1, 391.3, 361.7, 365.3, 303.2, 355.8, 334.2, 355.3, 383.3, 283.4, 387, 386.1, 366.4, 168.1, 346.2, 325.3, 346, 391.8, 381.7, 404.4, 417.7, 405.9, 419.1, 415.2, 344, 342.9, 319.4, 348.8, 347.6, 304.7, 379.1, 368, 365.3, 341.3, 317.6, 358.3, 376.9, 287.9, 163.6, 234.6, 304.9, 367.3, 380.2, 364.4, 364.6, 330.4, 401.8, 329.1, 292.8, 320.6, 275.8, 251.8, 554.5, 407.6, 400.8, 357.3, 350.4, 322.8, 336.1, 319.2, 306.4, 353.8, 329.6, 305.3, 318, 352.9, 334.3, 304.1, 329.1, 388.4, 374.5, 362.8, 362.6, 347.9, 341.1, 320.6, 312.4, 306.6, 320, 310.2, 367.1, 300.5, 366, 259.6, 156.1, 366.3, 365.7, 377.2, 300, 239.6, 376.9, 413.2, 240, 294.5, 250, 175, 314.8, 348.4, 354, 310, 250, 301.1, 356.1, 389.9, 326, 390.8, 320.6, 345.3, 307.9, 370.7, 374.6, 355.6, 396.5, 450.2, 418, 392.4, 384.3, 367.7, 527.2, 302.5, 291, 388.5, 356.7, 332.1, 387.6, 341.9, 314.7, 379.2, 376.5, 358.1, 354, 306.3, 358.3, 351, 330.5, 300.4, 323, 272.1, 295, 296.2, 280.4, 288.8, 356.3, 334.7, 334.7, 330.5, 321.8, 297.6, 325.5, 307.2, 310.2, 347.4, 347.3, 374.3, 354.5, 307.8, 404.1, 352.7, 331.9, 350.5, 289.3, 303.1, 317.2, 305.5, 356.2, 343.1, 380.7, 306.6, 319, 332, 308.2, 351.6, 365.7, 379.6, 383.1, 324.8, 270.4, 224.7, 197.9, 331.9, 356.9, 384.2, 356.7, 366.7, 333.3, 322.9, 322, 368.9, 322, 333.7, 302.9, 347, 363.1, 363.5, 364.4, 355.9, 327.8, 373.5, 349.5, 381.9, 382, 365, 332.1, 345.1, 332.5, 334.9, 312.5, 346.3, 267.1, 300.6, 295.1, 379, 355.6, 370.5, 321.5, 159.2, 336.7, 300, 300.6, 407.7, 376.1, 341.8, 354.5, 314.7, 309.9, 333.5, 363.7, 372.8, 317, 345.7, 49.9, 363.6, 392.2, 399.6, 342.4, 292.6, 353.8, 374.3, 363.8, 335.3, 359.9, 386.7, 341.4, 319.6, 337.1, 336.1, 306.4, 329.3, 217.9, 365.3, 352.7, 311.2, 324.5, 354.2, 263, 233.3, 345.3, 279.3, 303.1, 309.6, 341.3, 383.1, 359.6, 454.2, 302.4, 293.5, 364.3, 330.4, 449.4, 359.1, 171.7, 280.2, 329.6, 302.6, 344.7, 396.2, 366.6, 397, 353.6, 333.1, 392.5, 432.2, 337.3, 334.9, 355.4, 373.3, 359.2, 313.8, 347, 388.4, 357.8, 371.7, 319.2, 323.9, 304.1, 290.9, 363.1, 333.3, 332.3, 325.3, 272.3, 304.9, 276.8, 293.1, 391.4, 289.7, 354, 378.8, 376.4, 351.8, 328.4, 363.1, 380.4, 371.8, 336.5, 316.2, 344.1, 325.7, 287.6, 346.4, 345.4, 318.1, 312.7, 290.9, 374.7, 353.5, 357.6, 267.4, 260.3, 342.4, 326.1, 307.3, 301.8, 264.4, 298.8, 297.3, 291.1, 297.9, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 309.1, 313.6, 315.3, 316, 316.3, 316.4, 316.4, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5, 316.5],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 333.4, 340.3, 342.6, 343.6, 344, 344.3, 344.4, 344.5, 344.7, 344.8, 344.9, 345, 345.1, 345.2, 345.3, 345.4, 345.5, 345.6, 345.7, 345.7, 345.8, 345.9, 346, 346.1, 346.2, 346.3, 346.4, 346.5, 346.6, 346.7, 346.8, 346.9, 347, 347.1, 347.2, 347.3, 347.4, 347.5, 347.5, 347.6, 347.7, 347.8, 347.9, 348, 348.1, 348.2, 348.3, 348.4, 348.5, 348.5],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 284.8, 286.9, 288, 288.4, 288.6, 288.5, 288.5, 288.4, 288.3, 288.2, 288.1, 288, 287.9, 287.8, 287.7, 287.6, 287.5, 287.4, 287.3, 287.2, 287.1, 287, 286.9, 286.8, 286.7, 286.6, 286.5, 286.4, 286.3, 286.2, 286.1, 286.1, 286, 285.9, 285.8, 285.7, 285.6, 285.5, 285.4, 285.3, 285.2, 285.1, 285, 284.9, 284.9, 284.8, 284.7, 284.6, 284.5, 284.4],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });            


                /**
                  吳郭魚
                **/
                $( "#a2_2" ).click(function() {

                  var myChart = ec.init(document.getElementById('chart2_2')); 
                  var option = {
                    tooltip: {
                        show: true
                    },
                    toolbox: {
                      show : true,
                      feature : {
                          restore : {show: true},
                          saveAsImage : {show: true}
                      }
                    },
                    title : {
                        text: '吳郭魚',
                        subtext: '近期價錢趨勢'
                    },
                    legend: {
                        data:['市場價','預測價','下界','上界']
                    },
                    dataZoom : {
                        show : true,
                        realtime: true,
                        start : 0,
                        end : 100
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : ['2015/1/1', '2015/1/2', '2015/1/3', '2015/1/4', '2015/1/6', '2015/1/7', '2015/1/8', '2015/1/9', '2015/1/10', '2015/1/11', '2015/1/13', '2015/1/14', '2015/1/15', '2015/1/16', '2015/1/17', '2015/1/18', '2015/1/20', '2015/1/21', '2015/1/22', '2015/1/23', '2015/1/24', '2015/1/25', '2015/1/27', '2015/1/28', '2015/1/29', '2015/1/30', '2015/1/31', '2015/2/1', '2015/2/3', '2015/2/4', '2015/2/5', '2015/2/6', '2015/2/7', '2015/2/8', '2015/2/10', '2015/2/11', '2015/2/12', '2015/2/13', '2015/2/14', '2015/2/15', '2015/2/16', '2015/2/17', '2015/2/18', '2015/2/25', '2015/2/26', '2015/2/27', '2015/2/28', '2015/3/1', '2015/3/3', '2015/3/4', '2015/3/5', '2015/3/10', '2015/3/11', '2015/3/12', '2015/3/13', '2015/3/14', '2015/3/15', '2015/3/17', '2015/3/18', '2015/3/19', '2015/3/20', '2015/3/21', '2015/3/22', '2015/3/24', '2015/3/25', '2015/3/26', '2015/3/27', '2015/3/28', '2015/3/29', '2015/3/31', '2015/4/1', '2015/4/2', '2015/4/3', '2015/4/4', '2015/4/5', '2015/4/11', '2015/4/12', '2015/4/14', '2015/4/15', '2015/4/16', '2015/4/17', '2015/4/18', '2015/4/19', '2015/4/21', '2015/4/22', '2015/4/23', '2015/4/24', '2015/4/25', '2015/4/26', '2015/4/28', '2015/4/29', '2015/4/30', '2015/5/1', '2015/5/2', '2015/5/3', '2015/5/5', '2015/5/6', '2015/5/7', '2015/5/8', '2015/5/9', '2015/5/10', '2015/5/12', '2015/5/13', '2015/5/14', '2015/5/15', '2015/5/16', '2015/5/17', '2015/5/19', '2015/5/20', '2015/5/21', '2015/5/22', '2015/5/23', '2015/5/24', '2015/5/26', '2015/5/27', '2015/5/28', '2015/5/29', '2015/5/30', '2015/5/31', '2015/6/2', '2015/6/3', '2015/6/4', '2015/6/5', '2015/6/6', '2015/6/7', '2015/6/9', '2015/6/10', '2015/6/11', '2015/6/12', '2015/6/13', '2015/6/14', '2015/6/16', '2015/6/17', '2015/6/18', '2015/6/19', '2015/6/20', '2015/6/23', '2015/6/24', '2015/6/25', '2015/6/26', '2015/6/27', '2015/6/28', '2015/6/30', '2015/7/1', '2015/7/2', '2015/7/3', '2015/7/4', '2015/7/5', '2015/7/7', '2015/7/8', '2015/7/9', '2015/7/10', '2015/7/11', '2015/7/12', '2015/7/14', '2015/7/15', '2015/7/16', '2015/7/17', '2015/7/18', '2015/7/19', '2015/7/21', '2015/7/22', '2015/7/23', '2015/7/24', '2015/7/25', '2015/7/26', '2015/7/28', '2015/7/29', '2015/7/30', '2015/7/31', '2015/8/1', '2015/8/2', '2015/8/4', '2015/8/5', '2015/8/6', '2015/8/7', '2015/8/8', '2015/8/9', '2015/8/11', '2015/8/12', '2015/8/13', '2015/8/14', '2015/8/15', '2015/8/16', '2015/8/18', '2015/8/19', '2015/8/20', '2015/8/21', '2015/8/22', '2015/8/23', '2015/8/25', '2015/8/26', '2015/8/27', '2015/8/28', '2015/9/1', '2015/9/2', '2015/9/3', '2015/9/4', '2015/9/5', '2015/9/6', '2015/9/8', '2015/9/9', '2015/9/10', '2015/9/11', '2015/9/12', '2015/9/13', '2015/9/15', '2015/9/16', '2015/9/17', '2015/9/18', '2015/9/19', '2015/9/20', '2015/9/22', '2015/9/23', '2015/9/24', '2015/9/25', '2015/9/26', '2015/9/27', '2015/9/30', '2015/10/1', '2015/10/2', '2015/10/3', '2015/10/4', '2015/10/6', '2015/10/7', '2015/10/8', '2015/10/9', '2015/10/10', '2015/10/11', '2015/10/13', '2015/10/14', '2015/10/15', '2015/10/16', '2015/10/17', '2015/10/18', '2015/10/20', '2015/10/21', '2015/10/22', '2015/10/23', '2015/10/24', '2015/10/25', '2015/10/27', '2015/10/28', '2015/10/29', '2015/10/30', '2015/10/31', '2015/11/1', '2015/11/3', '2015/11/4', '2015/11/5', '2015/11/6', '2015/11/7', '2015/11/8', '2015/11/10', '2015/11/11', '2015/11/12', '2015/11/13', '2015/11/14', '2015/11/15', '2015/11/17', '2015/11/18', '2015/11/19', '2015/11/20', '2015/11/21', '2015/11/22', '2015/11/24', '2015/11/25', '2015/11/26', '2015/11/27', '2015/11/28', '2015/11/29', '2015/12/1', '2015/12/2', '2015/12/3', '2015/12/4', '2015/12/5', '2015/12/6', '2015/12/8', '2015/12/9', '2015/12/10', '2015/12/11', '2015/12/12', '2015/12/13', '2015/12/15', '2015/12/16', '2015/12/17', '2015/12/18', '2015/12/19', '2015/12/20', '2015/12/22', '2015/12/23', '2015/12/24', '2015/12/25', '2015/12/26', '2015/12/27', '2015/12/29', '2015/12/30', '2015/12/31', '2016/1/1', '2016/1/2', '2016/1/3', '2016/1/5', '2016/1/6', '2016/1/7', '2016/1/8', '2016/1/9', '2016/1/10', '2016/1/12', '2016/1/13', '2016/1/14', '2016/1/15', '2016/1/16', '2016/1/17', '2016/1/19', '2016/1/20', '2016/1/21', '2016/1/22', '2016/1/23', '2016/1/24', '2016/1/26', '2016/1/27', '2016/1/28', '2016/1/29', '2016/1/30', '2016/1/31', '2016/2/2', '2016/2/3', '2016/2/4', '2016/2/5', '2016/2/6', '2016/2/7', '2016/2/16', '2016/2/17', '2016/2/18', '2016/2/19', '2016/2/20', '2016/2/21', '2016/2/24', '2016/2/25', '2016/2/26', '2016/2/27', '2016/2/28', '2016/3/1', '2016/3/2', '2016/3/3', '2016/3/4', '2016/3/5', '2016/3/6', '2016/3/8', '2016/3/9', '2016/3/10', '2016/3/11', '2016/3/12', '2016/3/13', '2016/3/15', '2016/3/16', '2016/3/17', '2016/3/18', '2016/3/19', '2016/3/20', '2016/3/22', '2016/3/23', '2016/3/24', '2016/3/25', '2016/3/26', '2016/3/27', '2016/3/29', '2016/3/30', '2016/3/31', '2016/4/1', '2016/4/2', '2016/4/3', '2016/4/4', '2016/4/10', '2016/4/12', '2016/4/13', '2016/4/14', '2016/4/15', '2016/4/16', '2016/4/17', '2016/4/19', '2016/4/20', '2016/4/21', '2016/4/22', '2016/4/23', '2016/4/24', '2016/4/26', '2016/4/27', '2016/4/28', '2016/4/29', '2016/4/30', '2016/5/1', '2016/5/3', '2016/5/4', '2016/5/5', '2016/5/6', '2016/5/7', '2016/5/8', '2016/5/10', '2016/5/11', '2016/5/12', '2016/5/13', '2016/5/14', '2016/5/15', '2016/5/17', '2016/5/18', '2016/5/19', '2016/5/20', '2016/5/21', '2016/5/22', '2016/5/24', '2016/5/25', '2016/5/26', '2016/5/27', '2016/5/28', '2016/5/29', '2016/5/31', '2016/6/1', '2016/6/2', '2016/6/3', '2016/6/4', '2016/6/5', '2016/6/7', '2016/6/8', '2016/6/9', '2016/6/12', '2016/6/14', '2016/6/15', '2016/6/16', '2016/6/17', '2016/6/18', '2016/6/19', '2016/6/21', '2016/6/22', '2016/6/23', '2016/6/24', '2016/6/25', '2016/6/26', '2016/6/28', '2016/6/29', '2016/6/30', '2016/7/1', '2016/7/2', '2016/7/3', '2016/7/5', '2016/7/6', '2016/7/7', '2016/7/8', '2016/7/9', '2016/7/10', '2016/7/12', '2016/7/13', '2016/7/14', '2016/7/15', '2016/7/16', '2016/7/17', '2016/7/19', '2016/7/20', '2016/7/21', '2016/7/22', '2016/7/23', '2016/7/24', '2016/7/26', '2016/7/27', '2016/7/28', '2016/7/29', '2016/7/30', '2016/7/31', '2016/8/2', '2016/8/3', '2016/8/4', '2016/8/5', '2016/8/6', '2016/8/7', '2016/8/9', '2016/8/10', '2016/8/11', '2016/8/12', '2016/8/13', '2016/8/14', '2016/8/16', '2016/8/17', '2016/8/20', '2016/8/21', '2016/8/23', '2016/8/24', '2016/8/25', '2016/8/26', '2016/8/27', '2016/8/28', '2016/8/30', '2016/8/31', '2016/9/1', '2016/9/2', '2016/9/3', '2016/9/4', '2016/9/6', '2016/9/7', '2016/9/8', '2016/9/9', '2016/9/10', '2016/9/11', '2016/9/13', '2016/9/14', '2016/9/15', '2016/9/16', '2016/9/17', '2016/9/21', '2016/9/22', '2016/9/23', '2016/9/24', '2016/9/25', '2016/9/27', '2016/9/28', '2016/9/29', '2016/9/30', '2016/10/1', '2016/10/2', '2016/10/4', '2016/10/5', '2016/10/6', '2016/10/7', '2016/10/8', '2016/10/9', '2016/10/11', '2016/10/12', '2016/10/13', '2016/10/14', '2016/10/15', '2016/10/16', '2016/10/18', '2016/10/19', '2016/10/20', '2016/10/21', '2016/10/22', '2016/10/23', '2016/10/25', '2016/10/26', '2016/10/27', '2016/10/28', '2016/10/29', '2016/10/30', '2016/11/1', '2016/11/2', '2016/11/3', '2016/11/4', '2016/11/5', '2016/11/6', '2016/11/8', '2016/11/9', '2016/11/10', '2016/11/11', '2016/11/12', '2016/11/13', '2016/11/15', '2016/11/16', '2016/11/17', '2016/11/18', '2016/11/19', '2016/11/20', '2016/11/22', '2016/11/23', '2016/11/24', '2016/11/25', '2016/11/26', '2016/11/27', '2016/11/29', '2016/11/30', '2016/12/1', '2016/12/2', '2016/12/3', '2016/12/4', '2016/12/6', '2016/12/7', '2016/12/8', '2016/12/9', '2016/12/10', '2016/12/11', '2016/12/13', '2016/12/14', '2016/12/15', '2016/12/16', '2016/12/17', '2016/12/18', '2016/12/20', '2016/12/21', '2016/12/22', '2016/12/23', '2016/12/24', '2016/12/25', '2016/12/27', '2016/12/28', '2016/12/29', '2016/12/30', '2016/12/31', '2017/1/1', '2017/1/2', '2017/1/3', '2017/1/4', '2017/1/5', '2017/1/6', '2017/1/7', '2017/1/8', '2017/1/9', '2017/1/10', '2017/1/11', '2017/1/12', '2017/1/13', '2017/1/14', '2017/1/15', '2017/1/16', '2017/1/17', '2017/1/18', '2017/1/19', '2017/1/20', '2017/1/21', '2017/1/22', '2017/1/23', '2017/1/24', '2017/1/25', '2017/1/26', '2017/1/27', '2017/1/28', '2017/1/29', '2017/1/30', '2017/1/31', '2017/2/1', '2017/2/2', '2017/2/3', '2017/2/4', '2017/2/5', '2017/2/6', '2017/2/7', '2017/2/8', '2017/2/9', '2017/2/10', '2017/2/11', '2017/2/12', '2017/2/13', '2017/2/14', '2017/2/15', '2017/2/16', '2017/2/17', '2017/2/18', '2017/2/19', '2017/2/20', '2017/2/21', '2017/2/22', '2017/2/23', '2017/2/24', '2017/2/25', '2017/2/26', '2017/2/27', '2017/2/28', '2017/3/1']
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            "name":"市場價",
                            "type":'line',
                            "data":[73.2, 68.6, 73.7, 88.5, 70.6, 68, 65.6, 71.1, 72.5, 70.1, 70.2, 68.9, 69.9, 69.5, 75.1, 73, 76.5, 73.6, 74.5, 76.3, 79.2, 74.5, 80.4, 78.1, 72.6, 75.2, 81.4, 80.4, 82, 74.2, 74.7, 80.2, 80.3, 76.7, 73.1, 81.1, 77.3, 85.4, 85.1, 88.8, 77.1, 73.3, 98.2, 79.8, 81.3, 81.6, 83.8, 81, 80.4, 82.4, 85.9, 83, 76.5, 72.9, 77.4, 82.1, 79.2, 78.9, 71.8, 73.1, 71.1, 77.2, 73, 73.6, 67.9, 67.6, 66.5, 76.4, 76.5, 74.4, 76, 77.7, 76.1, 85.6, 87.8, 86.4, 82.5, 83.8, 75.2, 73.6, 71.1, 78.6, 79, 71.1, 72.6, 69.6, 70.1, 76.4, 75.4, 70.7, 71.7, 71.1, 72.7, 75.7, 71.6, 72.2, 69.3, 71.2, 87.7, 77.6, 74.8, 73.7, 73.8, 71, 67.4, 78.3, 76.3, 73.4, 68.7, 66.6, 75.1, 76.8, 71.3, 73.3, 73.9, 73.9, 72, 75.9, 75.9, 74.3, 74.4, 71.7, 71.9, 79.9, 81.3, 73.9, 76.2, 71.3, 70.7, 77.4, 72.9, 75.7, 71.5, 72.6, 80.2, 83.8, 78.6, 72.8, 71.1, 70.8, 78.2, 76.4, 74.7, 74.4, 74.1, 73.2, 79.3, 76, 74.8, 72.6, 79.9, 76.8, 80.4, 81, 75.5, 74.3, 69.3, 72.4, 78.1, 74.4, 73.4, 72.2, 77.6, 68.2, 76.6, 73.6, 74.9, 72.1, 68.8, 70.9, 81.3, 75.7, 76.2, 72.9, 91, 78.1, 71, 76.6, 76.1, 73.9, 69, 72, 78.1, 95.7, 78.3, 76, 69.3, 70.5, 74.2, 68.8, 75, 71.7, 78.3, 73.5, 74.1, 75.1, 74.2, 70.3, 76.4, 74.8, 75.8, 73.3, 74, 71.7, 78.2, 77.6, 76.5, 72, 65.7, 68.7, 76.4, 75.4, 70.3, 65.7, 66.8, 78.9, 80.1, 80.6, 75.6, 71, 67.6, 75.6, 68.7, 65.9, 66.5, 66.9, 69.5, 72.4, 74.1, 72.9, 69.4, 71, 69.3, 75.4, 69.8, 71.3, 67.8, 76.1, 70, 77, 74.8, 67.1, 62.7, 64, 84.4, 73.5, 72.3, 69.6, 66.3, 63.6, 62.6, 65.5, 65, 66.3, 60.1, 66.5, 63.9, 65.1, 60.5, 61, 58.7, 58.8, 65.5, 66.5, 64.7, 62.4, 63.1, 63.9, 62.2, 67.7, 64.2, 58.8, 61.2, 63.7, 64, 70.7, 64.5, 63.2, 59, 73.6, 51.9, 58.3, 68.2, 63.8, 53.8, 54.7, 54.1, 55.2, 49.8, 65.8, 58.7, 59.3, 56.4, 60.9, 55.1, 54.2, 51.8, 55.7, 60.1, 66.3, 65.8, 65.2, 60.7, 60.1, 62.7, 57.6, 61.9, 67.2, 68.7, 65.5, 69.9, 67, 68.3, 67, 71.2, 68.4, 67.7, 70.2, 62.8, 65.5, 64.4, 63.7, 65.3, 70.3, 70.9, 72.1, 78, 75.5, 69, 71, 88.3, 53.2, 73.4, 71.9, 88.1, 78.9, 79.9, 79.6, 76.2, 69.3, 72.9, 76.5, 75.2, 71.9, 66.7, 59, 69.6, 72, 71.6, 67.7, 68.6, 61.8, 73.5, 68.6, 72.7, 66.7, 61.3, 66.9, 73.6, 74.4, 71.2, 71.4, 65.2, 68.5, 76.4, 77.1, 75.3, 77.4, 70.9, 69.4, 78.3, 78.9, 88, 90, 74.1, 70.5, 61.3, 59.8, 68.2, 66.2, 70.4, 64.2, 61.7, 64.9, 65.3, 66.1, 61.7, 61.5, 59.9, 61, 64.6, 63.9, 66.3, 63, 47.9, 50.2, 52.3, 50.5, 45.9, 41.9, 53.3, 42.8, 41.8, 45, 59.8, 59.6, 59.1, 62.9, 68.9, 68.5, 66.5, 63.7, 62.2, 61.6, 62, 62.7, 55, 58.6, 56.6, 60.8, 65.9, 66.1, 66.7, 73.4, 76.2, 79.8, 71.9, 62.4, 61.2, 59.8, 67.3, 63.7, 63.3, 63.2, 60.1, 62, 65.7, 65.3, 61.4, 59, 61.9, 59.9, 66.9, 67.2, 62, 60.8, 64.8, 68.8, 70.7, 78.6, 71.5, 67.6, 63.5, 64.7, 65.1, 67.5, 65.7, 62.5, 60.8, 65.4, 66.6, 66.2, 61.1, 60.8, 60.6, 62.7, 67.1, 61.4, 64.3, 61.4, 63.4, 58.4, 68.3, 65.4, 60, 55, 57.1, 63.3, 66.7, 66.1, 68.9, 72.2, 69.9, 65.2, 70.6, 66.5, 58.8, 58.5, 62.6, 65, 64.8, 62.6, 63.1, 59.7, 64.5, 66, 62.7, 56.8, 57.3, 62.7, 68.3, 69.1, 71.7, 84.3, 83.4, 55.9, 59.8, 59.5, 63.5, 54.7, 65.9, 62.8, 67.2, 66.9, 71.7, 62.3, 66.4, 65.8, 66.1, 59, 57.6, 57.3, 67.4, 69.6, 64.5, 56.2, 55.7, 54.8, 58.8, 63.6, 59.6, 49.7, 53.3, 53.9, 63, 54.1, 56.1, 50.6, 45.2, 52.7, 59.8, 59.5, 55.6, 58.7, 60.8, 52.7, 61.7, 58.2, 52.5, 55.2, 53.9, 48.8, 57.9, 58.6, 58.4, 54.7, 55, 52.5, 59.1, 59.9, 44.5, 52, 51.7, 51.9, 61.5, 59, 62.9, 57.4, 60.6, 57.6, 63.5, 58.8, 61.8, 58.2, 59.7, 55, 61.9, 58.9, 47.7, 51.1, 53, 52.6, 54.1, 74, 58.7, 58.6, 54.1, 48.9, 56.8, 57.4, 55.4, 52.8, 49.8, 55.1, 60.8, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
                            markPoint : {
                                data : [
                                    // 纵轴，默认
                                    {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                    {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                ]
                            },
                        },
                        {
                            "name":"預測價",
                            "type":'line',
                            "data":['-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 60, 56.9, 55.6, 55.1, 55.2, 57.5, 57.7, 56.7, 55.6, 54.9, 56, 57.3, 57.4, 56.6, 55.4, 55.2, 56.2, 57.2, 57.3, 56.3, 55.4, 55.5, 56.4, 57.2, 57.1, 56.2, 55.5, 55.7, 56.5, 57.1, 56.9, 56.1, 55.6, 55.9, 56.6, 57, 56.7, 56, 55.7, 56, 56.7, 56.9, 56.6, 56, 55.8, 56.2, 56.7, 56.8, 56.4, 55.9, 55.9, 56.3, 56.7, 56.7, 56.3, 55.9, 56, 56.3, 56.7, 56.6],
                            markPoint : {
                                data : [
                                    // 纵轴，默认
                                    {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                    {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                ]
                            },
                        },
                        {
                            "name":"下界",
                            "type":'line',
                            "data":['-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 57.4, 54, 52.6, 52.1, 52.1, 54.3, 54.5, 53.4, 52.3, 51.4, 52.5, 53.8, 53.8, 53, 51.7, 51.5, 52.4, 53.3, 53.4, 52.4, 51.4, 51.4, 52.3, 53.1, 52.9, 51.9, 51.2, 51.4, 52.2, 52.7, 52.4, 51.6, 51, 51.3, 52, 52.4, 52, 51.2, 50.9, 51.2, 51.8, 52, 51.6, 50.9, 50.7, 51.1, 51.6, 51.7, 51.2, 50.7, 50.6, 51, 51.4, 51.4, 50.9, 50.5, 50.5, 50.8, 51.1, 51],
                        },
                        {
                            "name":"上界",
                            "type":'line',
                            "data":['-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 62.5, 59.7, 58.6, 58.2, 58.3, 60.6, 60.9, 60, 59, 58.3, 59.5, 60.8, 61, 60.3, 59.1, 59, 60, 61, 61.2, 60.3, 59.4, 59.5, 60.5, 61.3, 61.3, 60.4, 59.8, 60, 60.9, 61.5, 61.3, 60.6, 60.1, 60.5, 61.2, 61.7, 61.4, 60.8, 60.5, 60.9, 61.5, 61.8, 61.5, 61, 60.8, 61.2, 61.8, 62, 61.6, 61.2, 61.1, 61.6, 62, 62.1, 61.8, 61.4, 61.4, 61.9, 62.2, 62.2],
                            }
                        ]
                    };
                    myChart.setOption(option); 
                });

                /**
                  茼蒿
                **/
                $( "#a2_3" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart2_3')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '茼蒿',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/2", "2015/1/3", "2015/1/4", "2015/1/6", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/10", "2015/1/11", "2015/1/13", "2015/1/14", "2015/1/15", "2015/1/16", "2015/1/17", "2015/1/18", "2015/1/20", "2015/1/21", "2015/1/22", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/28", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/5", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/15", "2015/2/16", "2015/2/17", "2015/2/18", "2015/2/24", "2015/2/25", "2015/2/26", "2015/2/28", "2015/3/1", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/6", "2015/3/10", "2015/3/11", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/15", "2015/3/17", "2015/3/18", "2015/3/19", "2015/3/20", "2015/3/21", "2015/3/22", "2015/3/24", "2015/3/25", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/7", "2015/4/8", "2015/4/9", "2015/4/10", "2015/4/11", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/16", "2015/4/17", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/22", "2015/4/23", "2015/4/24", "2015/4/25", "2015/4/26", "2015/4/28", "2015/4/29", "2015/4/30", "2015/5/1", "2015/5/2", "2015/5/3", "2015/9/30", "2015/10/6", "2015/10/8", "2015/10/9", "2015/10/10", "2015/10/13", "2015/10/16", "2015/10/17", "2015/10/18", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/24", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/29", "2015/10/30", "2015/10/31", "2015/11/1", "2015/11/3", "2015/11/4", "2015/11/5", "2015/11/6", "2015/11/7", "2015/11/8", "2015/11/10", "2015/11/11", "2015/11/12", "2015/11/13", "2015/11/14", "2015/11/15", "2015/11/17", "2015/11/18", "2015/11/19", "2015/11/20", "2015/11/21", "2015/11/22", "2015/11/24", "2015/11/25", "2015/11/26", "2015/11/27", "2015/11/28", "2015/11/29", "2015/12/1", "2015/12/2", "2015/12/3", "2015/12/4", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/9", "2015/12/10", "2015/12/11", "2015/12/12", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/17", "2015/12/18", "2015/12/19", "2015/12/20", "2015/12/22", "2015/12/23", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/27", "2015/12/29", "2015/12/30", "2015/12/31", "2016/1/1", "2016/1/2", "2016/1/3", "2016/1/5", "2016/1/6", "2016/1/7", "2016/1/8", "2016/1/9", "2016/1/10", "2016/1/12", "2016/1/13", "2016/1/14", "2016/1/15", "2016/1/16", "2016/1/17", "2016/1/19", "2016/1/20", "2016/1/21", "2016/1/22", "2016/1/23", "2016/1/24", "2016/1/26", "2016/1/27", "2016/1/28", "2016/1/29", "2016/1/30", "2016/1/31", "2016/2/1", "2016/2/2", "2016/2/3", "2016/2/4", "2016/2/5", "2016/2/6", "2016/2/7", "2016/2/13", "2016/2/14", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/21", "2016/2/25", "2016/2/26", "2016/2/27", "2016/2/28", "2016/3/1", "2016/3/2", "2016/3/3", "2016/3/4", "2016/3/5", "2016/3/6", "2016/3/8", "2016/3/9", "2016/3/10", "2016/3/11", "2016/3/12", "2016/3/13", "2016/3/15", "2016/3/16", "2016/3/17", "2016/3/18", "2016/3/19", "2016/3/20", "2016/3/22", "2016/3/23", "2016/3/24", "2016/3/25", "2016/3/26", "2016/3/27", "2016/3/29", "2016/3/30", "2016/3/31", "2016/4/1", "2016/4/2", "2016/4/3", "2016/4/6", "2016/4/7", "2016/4/8", "2016/4/9", "2016/4/10", "2016/4/12", "2016/4/13", "2016/4/14", "2016/4/15", "2016/4/16", "2016/4/17", "2016/4/19", "2016/4/21", "2016/4/23", "2016/4/27", "2016/4/28", "2016/10/2", "2016/10/8", "2016/10/13", "2016/10/14", "2016/10/15", "2016/10/16", "2016/10/18", "2016/10/19", "2016/10/21", "2016/10/22", "2016/10/26", "2016/10/28", "2016/10/29", "2016/10/30", "2016/11/1", "2016/11/2", "2016/11/3", "2016/11/4", "2016/11/5", "2016/11/6", "2016/11/8", "2016/11/9", "2016/11/10", "2016/11/11", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/16", "2016/11/17", "2016/11/18", "2016/11/19", "2016/11/20", "2016/11/22", "2016/11/23", "2016/11/24", "2016/11/25", "2016/11/26", "2016/11/27", "2016/11/29", "2016/11/30", "2016/12/1", "2016/12/2", "2016/12/3", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/8", "2016/12/9", "2016/12/10", "2016/12/11", "2016/12/13", "2016/12/14", "2016/12/15", "2016/12/16", "2016/12/17", "2016/12/18", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/24", "2016/12/25", "2016/12/27", "2016/12/28", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/3", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/11", "2017/1/12", "2017/1/13", "2017/1/14", "2017/1/15", "2017/1/17", "2017/1/18", "2017/1/19", "2017/1/20", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/1/26", "2017/1/27", "2017/2/2", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/15", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/19", "2017/2/21", "2017/2/22", "2017/2/23", "2017/2/24", "2017/2/25", "2017/2/26", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/3", "2017/3/4", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/3", "2017/4/6", "2017/4/7", "2017/4/8", "2017/4/9", "2017/4/11", "2017/4/12", "2017/4/13", "2017/4/14", "2017/4/15", "2017/4/16", "2017/4/18", "2017/4/19", "2017/4/20", "2017/4/21", "2017/4/22", "2017/4/23", "2017/4/25", "2017/4/26", "2017/4/27", "2017/4/28", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/4", "2017/5/7", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/16", "2017/5/17", "2017/5/18", "2017/5/20", "2017/5/21", "2017/5/23", "2017/5/24", "2017/5/25", "2017/5/26", "2017/5/27", "2017/5/28", "2017/10/14", "2017/10/17", "2017/10/18", "2017/10/22", "2017/10/24", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/28", "2017/10/29", "2017/10/31", "2017/11/1", "2017/11/2", "2017/11/3", "2017/11/4", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/12", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13", "2018/1/14", "2018/1/15"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [18, 18.2, 22.3, 30.8, 27.1, 25.4, 21.7, 18.7, 14.3, 11.3, 15.9, 13.7, 14.8, 10.7, 9.2, 10.3, 13.1, 11.3, 11.6, 12.4, 12.2, 13, 19, 13.6, 12.3, 11.1, 12.5, 11.8, 11.3, 10.9, 9.4, 10.8, 13.4, 13.3, 14.7, 15.4, 16.6, 14, 14, 15.7, 19.8, 31.4, 35.8, 24.4, 17.9, 18, 20.1, 19, 21.4, 22.3, 29.7, 31.3, 40.3, 40.7, 44.7, 43.9, 36, 34.3, 29.9, 20.4, 12, 10.6, 12.6, 15, 16.4, 18, 20.2, 21, 22.7, 26.6, 28.4, 31.5, 30.1, 28.3, 29.8, 33.3, 30.1, 31.5, 31.3, 33.8, 36, 35.8, 31.6, 27.1, 27.7, 29.3, 26.2, 32.5, 30, 25.8, 22.7, 31.1, 24.7, 44.4, 24.2, 22.7, 19.3, 19.4, 18.9, 19, 27, 44.4, 35.5, 30.3, 46, 63.3, 72.3, 65.7, 61.5, 56.4, 51.2, 45.5, 53.3, 52.6, 49.2, 37.5, 34.5, 37.9, 46.2, 50.5, 53.6, 47.8, 43.7, 44.9, 44.8, 56.2, 44.4, 48, 50.2, 44.9, 41.6, 34.7, 25.6, 19.1, 16.3, 18.2, 22.6, 27.7, 30.2, 27.3, 35.2, 41.9, 50.3, 55.1, 58.1, 49.4, 47.7, 47.2, 44.9, 47.6, 53.1, 49.6, 49.6, 52.4, 32.2, 28.6, 26.9, 29.8, 27.3, 32.5, 37.5, 54.6, 44.3, 56.5, 45.4, 36.7, 33.8, 26.1, 28.5, 29.2, 32.8, 44.8, 43.8, 50.3, 42.8, 33.6, 34.3, 26.7, 27, 28.6, 38.2, 26.4, 30.6, 27.1, 36.5, 34.3, 36, 41.6, 46.9, 52.8, 43.2, 71, 64.3, 48.1, 49.3, 56.5, 49.7, 40.7, 35.7, 35.2, 45.3, 48.7, 50.1, 58.6, 79.4, 55.3, 48.7, 43, 43.4, 47.7, 48.9, 47.3, 41.7, 35.8, 36.9, 34.6, 34.7, 29.9, 23, 20, 17, 18.3, 16.3, 14.8, 13.2, 15.7, 22.6, 21, 27.2, 25, 26.1, 27, 24.3, 27.6, 25.5, 26.2, 31.4, 33.4, 42, 40.6, 44.7, 48, 41, 42.6, 27.1, 20.6, 22.8, 15.9, 13.3, 15.4, 16.2, 18.7, 13.5, 21.3, 11.4, 12.9, 14.2, 25, 14.9, 15, 7.3, 9.2, 40, 38, 99, 85, 107.4, 91, 77.8, 62.1, 49.8, 15, 42, 90, 57.7, 55.7, 61.4, 71.2, 73, 75.4, 78.9, 75.7, 66.2, 75.1, 74.6, 70.4, 67.9, 61.5, 51, 37.3, 29.4, 32.3, 37.1, 39.3, 35.5, 28.1, 39.9, 35.1, 40.7, 40.9, 43.6, 46.7, 46.9, 52.4, 58.7, 56, 57.6, 57, 48.5, 43.6, 38.1, 37.5, 35.9, 26.8, 21.8, 22.2, 33.6, 40.3, 39.9, 37.4, 30.7, 32.3, 31, 27.6, 27, 26.8, 33, 29.3, 23.2, 24.2, 25.9, 22.3, 19.6, 17.1, 16.3, 19.6, 21.4, 18, 14.5, 14.2, 15, 21.1, 15.7, 12.1, 12.2, 15.5, 14.6, 15, 19.2, 23.2, 33.7, 41.1, 30.9, 28.1, 24.2, 19.1, 15.7, 16.8, 20.6, 30.1, 30.3, 29.7, 30.4, 26.6, 22.9, 21.6, 26.1, 21.5, 22.4, 21.8, 23.4, 37.1, 47.6, 55.4, 55.1, 54, 40.7, 33.5, 36.3, 33.8, 38, 32.6, 28, 34.4, 30.7, 37.7, 34.4, 45.1, 50.1, 50.5, 47.7, 47.7, 39.7, 45.3, 38.1, 44.7, 40.3, 40.4, 47.8, 48.5, 42.5, 39.5, 42.6, 34.2, 29.5, 30.8, 27.7, 21.7, 19.9, 25.1, 28.7, 27.1, 18, 24.7, 18.7, 15.2, 21.8, 34.2, 30, 40.6, 38.6, 28.1, 40, 45, 35, 28, 57, 46.6, 37.5, 29.2, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, 66, 20.6, 22.5, 43.3, 40.9, 43, 40.8, 47.8, 75.1, 74.5, 75.4, 71.1, 78.4, 95.5, 92.6, 105.7, 88.8, 101.4, 78.2, 75.6, 73.8, 82.2, 57.3, 60.9, 41.6, 44.3, 40.8, 47.2, 43, 47.8, 56.1, 55.9, 67.1, 58, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9, 58.9],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 63.2, 64.6, 65.8, 66.7, 67.6, 68.4, 69.1, 69.8, 70.4, 71, 71.6, 72.1, 72.6, 73.1, 73.6, 74.1, 74.6, 75, 75.4, 75.9, 76.3, 76.7, 77.1, 77.5, 77.8, 78.2, 78.6, 78.9, 79.3, 79.6, 80, 80.3, 80.6, 81, 81.3, 81.6, 81.9, 82.2, 82.5, 82.8, 83.1, 83.4, 83.7, 84, 84.2, 84.5, 84.8, 85.1, 85.3, 85.6],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 54.7, 53.2, 52.1, 51.1, 50.3, 49.5, 48.8, 48.1, 47.5, 46.9, 46.3, 45.7, 45.2, 44.7, 44.2, 43.8, 43.3, 42.8, 42.4, 42, 41.6, 41.2, 40.8, 40.4, 40, 39.7, 39.3, 38.9, 38.6, 38.2, 37.9, 37.6, 37.2, 36.9, 36.6, 36.3, 36, 35.7, 35.4, 35.1, 34.8, 34.5, 34.2, 33.9, 33.6, 33.3, 33.1, 32.8, 32.5, 32.3],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });


                /**
                  芥菜
                **/
                $( "#a2_4" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart2_4')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '芥菜',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/2", "2015/1/3", "2015/1/4", "2015/1/6", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/10", "2015/1/11", "2015/1/13", "2015/1/14", "2015/1/15", "2015/1/16", "2015/1/17", "2015/1/18", "2015/1/20", "2015/1/21", "2015/1/22", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/28", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/5", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/15", "2015/2/16", "2015/2/17", "2015/2/18", "2015/2/24", "2015/2/25", "2015/2/26", "2015/2/28", "2015/3/1", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/6", "2015/3/10", "2015/3/11", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/15", "2015/3/17", "2015/3/18", "2015/3/19", "2015/3/20", "2015/3/21", "2015/3/22", "2015/3/24", "2015/3/25", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/7", "2015/4/8", "2015/4/9", "2015/4/10", "2015/4/11", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/28", "2015/4/30", "2015/5/1", "2015/5/2", "2015/5/3", "2015/5/5", "2015/5/6", "2015/5/7", "2015/5/8", "2015/5/9", "2015/5/10", "2015/5/12", "2015/5/13", "2015/5/14", "2015/5/15", "2015/5/16", "2015/5/17", "2015/5/19", "2015/5/20", "2015/5/21", "2015/5/30", "2015/5/31", "2015/6/2", "2015/6/3", "2015/6/4", "2015/6/5", "2015/6/6", "2015/6/7", "2015/6/10", "2015/6/12", "2015/6/13", "2015/6/16", "2015/6/19", "2015/6/20", "2015/7/15", "2015/7/31", "2015/9/22", "2015/9/24", "2015/9/25", "2015/9/27", "2015/10/1", "2015/10/9", "2015/10/20", "2015/10/21", "2015/10/22", "2015/10/23", "2015/10/24", "2015/10/25", "2015/10/27", "2015/10/28", "2015/10/29", "2015/10/30", "2015/10/31", "2015/11/1", "2015/11/3", "2015/11/7", "2015/11/8", "2015/11/10", "2015/11/11", "2015/11/12", "2015/11/13", "2015/11/14", "2015/11/15", "2015/11/17", "2015/11/18", "2015/11/19", "2015/11/20", "2015/11/21", "2015/11/22", "2015/11/24", "2015/11/25", "2015/11/26", "2015/11/27", "2015/11/28", "2015/11/29", "2015/12/1", "2015/12/2", "2015/12/3", "2015/12/4", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/9", "2015/12/10", "2015/12/11", "2015/12/12", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/17", "2015/12/18", "2015/12/19", "2015/12/20", "2015/12/22", "2015/12/23", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/27", "2015/12/29", "2015/12/30", "2015/12/31", "2016/1/1", "2016/1/2", "2016/1/3", "2016/1/5", "2016/1/6", "2016/1/7", "2016/1/8", "2016/1/9", "2016/1/10", "2016/1/12", "2016/1/13", "2016/1/14", "2016/1/15", "2016/1/16", "2016/1/17", "2016/1/19", "2016/1/20", "2016/1/21", "2016/1/22", "2016/1/23", "2016/1/24", "2016/1/26", "2016/1/27", "2016/1/28", "2016/1/29", "2016/1/30", "2016/1/31", "2016/2/1", "2016/2/2", "2016/2/3", "2016/2/4", "2016/2/5", "2016/2/6", "2016/2/7", "2016/2/13", "2016/2/14", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/21", "2016/2/25", "2016/2/26", "2016/2/27", "2016/2/28", "2016/3/1", "2016/3/2", "2016/3/3", "2016/3/4", "2016/3/5", "2016/3/6", "2016/3/8", "2016/3/9", "2016/3/10", "2016/3/11", "2016/3/12", "2016/3/13", "2016/3/15", "2016/3/16", "2016/3/17", "2016/3/18", "2016/3/19", "2016/3/20", "2016/3/22", "2016/3/23", "2016/3/24", "2016/3/26", "2016/3/27", "2016/3/29", "2016/4/7", "2016/4/10", "2016/4/14", "2016/4/15", "2016/4/16", "2016/4/17", "2016/4/19", "2016/4/20", "2016/4/21", "2016/4/23", "2016/4/24", "2016/4/29", "2016/4/30", "2016/5/1", "2016/5/3", "2016/5/8", "2016/6/3", "2016/6/4", "2016/7/2", "2016/8/17", "2016/9/13", "2016/9/14", "2016/9/18", "2016/10/1", "2016/10/2", "2016/10/4", "2016/10/5", "2016/10/6", "2016/10/7", "2016/10/8", "2016/10/9", "2016/10/12", "2016/10/14", "2016/10/15", "2016/10/16", "2016/10/18", "2016/10/26", "2016/11/10", "2016/11/11", "2016/11/12", "2016/11/13", "2016/11/15", "2016/11/16", "2016/11/17", "2016/11/18", "2016/11/19", "2016/11/20", "2016/11/22", "2016/11/23", "2016/11/24", "2016/11/25", "2016/11/26", "2016/11/27", "2016/11/29", "2016/11/30", "2016/12/1", "2016/12/2", "2016/12/3", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/8", "2016/12/9", "2016/12/10", "2016/12/11", "2016/12/13", "2016/12/14", "2016/12/15", "2016/12/16", "2016/12/17", "2016/12/18", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/24", "2016/12/25", "2016/12/27", "2016/12/28", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/3", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/11", "2017/1/12", "2017/1/13", "2017/1/14", "2017/1/15", "2017/1/17", "2017/1/18", "2017/1/19", "2017/1/20", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/1/26", "2017/1/27", "2017/2/2", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/15", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/19", "2017/2/21", "2017/2/22", "2017/2/23", "2017/2/24", "2017/2/25", "2017/2/26", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/3", "2017/3/4", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/3", "2017/4/6", "2017/4/7", "2017/4/8", "2017/4/11", "2017/4/12", "2017/4/13", "2017/4/14", "2017/4/15", "2017/4/16", "2017/4/18", "2017/4/22", "2017/4/25", "2017/4/28", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/3", "2017/5/17", "2017/8/16", "2017/9/22", "2017/9/24", "2017/9/27", "2017/9/30", "2017/10/1", "2017/10/4", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/12", "2017/10/13", "2017/10/14", "2017/10/15", "2017/10/17", "2017/10/18", "2017/10/20", "2017/10/22", "2017/10/25", "2017/10/26", "2017/10/27", "2017/10/29", "2017/10/31", "2017/11/1", "2017/11/2", "2017/11/3", "2017/11/4", "2017/11/5", "2017/11/7", "2017/11/8", "2017/11/9", "2017/11/10", "2017/11/11", "2017/11/12", "2017/11/14", "2017/11/15", "2017/11/16", "2017/11/17", "2017/11/18", "2017/11/19", "2017/11/21", "2017/11/22", "2017/11/23", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13", "2018/1/14", "2018/1/15"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [18.6, 20.4, 20.1, 19, 19.5, 18.3, 16.8, 16, 16.2, 13.8, 15.3, 13.7, 12.8, 10.8, 9.3, 7.6, 7.3, 7.3, 7.7, 7.7, 7.7, 7.4, 7.6, 8.4, 9, 11.4, 10.3, 8.6, 9.8, 7.2, 6.8, 6.8, 6.8, 7.5, 9, 9.9, 9.8, 10.6, 12.7, 11.4, 10.5, 15.5, 7.3, 10.3, 8.1, 7.9, 6, 12.5, 12.5, 13.2, 17.6, 17.8, 19.7, 17.9, 14.9, 16.8, 16.2, 19.9, 22.8, 22.3, 13.8, 10.1, 17.3, 13.1, 15.7, 13.5, 30.5, 19.2, 18.1, 22.4, 30.5, 26.9, 29.9, 25.2, 15.9, 31.7, 16, 32, 32.9, 33, 23.7, 26.9, 12.2, 21.8, 11.3, 36, 4, 31.9, 29.3, 20.7, 19.4, 15.2, 12.4, 9.2, 8.7, 6.1, 5.7, 6.6, 7.7, 6.5, 6, 8.3, 11.4, 10, 9.7, 14.4, 10, 27.3, 15.8, 16.6, 14, 26.1, 21.6, 20, 23, 21.5, 18, 22.2, 15, 5.3, 15, 25, 12, 15, 15, 26.7, 9.9, 20, 53.4, 34.6, 34.3, 25.4, 25.9, 31.3, 27, 36.3, 35, 31.7, 45, 34.9, 46.8, 20, 27.3, 31.6, 33, 34.1, 29, 23.7, 20.9, 26.1, 20.3, 23.3, 14.8, 14.9, 15.9, 19.5, 21.5, 19.5, 22.1, 22.4, 20.1, 23.8, 22, 18.1, 18, 21.8, 17.3, 20.8, 19.7, 18.6, 21.3, 13.7, 9.8, 12.8, 12.5, 11.7, 14.1, 12.7, 13.9, 14.2, 14.9, 13.6, 10.9, 12.1, 10.7, 12.3, 13.7, 11.3, 10.9, 11.9, 11.6, 10.5, 10.8, 13.3, 16.4, 15.2, 17.1, 19, 14.5, 10.4, 10.9, 12, 13.6, 21.5, 22.9, 20.7, 23, 21.7, 24, 46, 24.4, 17.7, 24.8, 24.9, 22.3, 14, 25.3, 32.6, 48.8, 33.5, 38, 94.3, 64.9, 56.3, 51.8, 59.7, 60.3, 59.1, 45.9, 35, 25.9, 62.3, 50.7, 23.8, 48.6, 54.3, 40, 37.4, 35.1, 30.6, 28.6, 25.8, 25.8, 26.9, 26.6, 39.2, 38.9, 53.3, 51.5, 43.8, 39.8, 58, 53.4, 50.9, 38.2, 35.4, 59.6, 57, 50, 5, 7.5, 25, 26.7, 23.7, 20, 21, 14, 15, 20, 19.4, 15.5, 20, 18.5, 17.9, 19.4, 21, 55, 28.3, 26, 24.7, 18.1, 11.1, 33.2, 24.3, 27.3, 24, 30.8, 41.7, 15, 50, 68, 52.8, 55, 45, 39.7, 45.4, 40, 41.4, 39.4, 30.9, 26.9, 26.1, 22.2, 29.6, 24.8, 24.3, 38.8, 30, 26.7, 22.7, 33.5, 33.7, 30, 34.9, 32.7, 25.7, 23.1, 27.8, 24.1, 21.1, 20.2, 17.8, 19.6, 20, 18.8, 16.8, 16.4, 15.3, 13.9, 12.6, 10, 8.2, 9.4, 9.1, 10.7, 10.8, 13.2, 11.2, 11, 8.2, 11.4, 10.1, 10.3, 10.6, 10, 9.8, 11.1, 9.8, 8.2, 8.2, 9.5, 8.7, 10.6, 9.6, 9.8, 11.9, 10.7, 10.8, 16.9, 29.5, 21, 4.1, 12.1, 10.3, 10, 9.6, 7.2, 8.9, 10.5, 12, 10.9, 8.2, 8.3, 11.9, 15.4, 10.9, 12.7, 9, 8.6, 5.8, 5.3, 4.8, 11.7, 7.6, 7.9, 6.9, 6.9, 5.6, 10.6, 10.5, 11, 10.8, 9.4, 9, 9.8, 10.2, 10.1, 7.3, 10.6, 11.1, 7.1, 5.8, 8.8, 6.8, 6.1, 6.6, 9.4, 12.2, 9.5, 8.5, 14.7, 17.8, 21.6, 22.8, 45, 26.4, 8.5, 12.9, 14.1, 14.8, 16.7, 11, 11.9, 18, 18, 30.6, 15.8, 40.7, 17, 15.9, 45, 20, 32, 18, 16.5, 18, 27.6, 30, 14.2, 16, 10.6, 11.2, 11.5, 12.8, 18.4, 18.6, 15.3, 14.2, 27, 35, 47, 50.6, 42.8, 43.1, 47, 38.4, 39.1, 32.3, 35.7, 29.8, 31.9, 32.8, 25.2, 25.6, 20.7, 19.3, 19.9, 21.9, 21.1, 22.5, 23, 25.3, 30.2, 26.5, 25, 26.8, 33.7, 31.7, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 30.3, 30.1, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 34.3, 34.6, 34.8, 35.1, 35.4, 35.7, 35.9, 36.2, 36.4, 36.6, 36.8, 37, 37.2, 37.4, 37.6, 37.8, 38, 38.2, 38.3, 38.5, 38.7, 38.8, 39, 39.2, 39.3, 39.5, 39.6, 39.8, 39.9, 40.1, 40.2, 40.4, 40.5, 40.6, 40.8, 40.9, 41, 41.2, 41.3, 41.4, 41.5, 41.7, 41.8, 41.9, 42, 42.1, 42.3, 42.4, 42.5, 42.6],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 26.3, 25.6, 25.2, 24.9, 24.6, 24.4, 24.1, 23.9, 23.6, 23.4, 23.2, 23, 22.8, 22.6, 22.4, 22.2, 22, 21.9, 21.7, 21.5, 21.3, 21.2, 21, 20.9, 20.7, 20.6, 20.4, 20.3, 20.1, 20, 19.8, 19.7, 19.5, 19.4, 19.3, 19.1, 19, 18.9, 18.8, 18.6, 18.5, 18.4, 18.3, 18.1, 18, 17.9, 17.8, 17.7, 17.5, 17.4],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                /**
                  草莓
                **/
                $( "#a2_5" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart2_5')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '草莓',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/2", "2015/1/3", "2015/1/4", "2015/1/6", "2015/1/7", "2015/1/8", "2015/1/9", "2015/1/10", "2015/1/11", "2015/1/13", "2015/1/14", "2015/1/15", "2015/1/16", "2015/1/17", "2015/1/18", "2015/1/20", "2015/1/21", "2015/1/22", "2015/1/23", "2015/1/24", "2015/1/25", "2015/1/27", "2015/1/28", "2015/1/29", "2015/1/30", "2015/1/31", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/5", "2015/2/6", "2015/2/7", "2015/2/8", "2015/2/10", "2015/2/11", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/15", "2015/2/16", "2015/2/17", "2015/2/18", "2015/2/24", "2015/2/25", "2015/2/26", "2015/2/28", "2015/3/1", "2015/3/3", "2015/3/4", "2015/3/5", "2015/3/6", "2015/3/10", "2015/3/11", "2015/3/12", "2015/3/13", "2015/3/14", "2015/3/15", "2015/3/17", "2015/3/18", "2015/3/19", "2015/3/20", "2015/3/21", "2015/3/22", "2015/3/24", "2015/3/25", "2015/3/26", "2015/3/27", "2015/3/28", "2015/3/29", "2015/3/31", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/7", "2015/4/8", "2015/4/9", "2015/4/10", "2015/4/11", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/16", "2015/4/21", "2015/5/10", "2015/11/6", "2015/11/11", "2015/11/12", "2015/11/15", "2015/11/17", "2015/11/18", "2015/11/19", "2015/11/20", "2015/11/21", "2015/11/22", "2015/11/24", "2015/11/25", "2015/11/26", "2015/11/27", "2015/11/28", "2015/11/29", "2015/12/1", "2015/12/2", "2015/12/3", "2015/12/4", "2015/12/5", "2015/12/6", "2015/12/8", "2015/12/9", "2015/12/10", "2015/12/11", "2015/12/12", "2015/12/13", "2015/12/15", "2015/12/16", "2015/12/17", "2015/12/18", "2015/12/19", "2015/12/20", "2015/12/22", "2015/12/23", "2015/12/24", "2015/12/25", "2015/12/26", "2015/12/27", "2015/12/29", "2015/12/30", "2015/12/31", "2016/1/1", "2016/1/2", "2016/1/3", "2016/1/5", "2016/1/6", "2016/1/7", "2016/1/8", "2016/1/9", "2016/1/10", "2016/1/12", "2016/1/13", "2016/1/14", "2016/1/15", "2016/1/16", "2016/1/17", "2016/1/19", "2016/1/20", "2016/1/21", "2016/1/22", "2016/1/23", "2016/1/24", "2016/1/26", "2016/1/27", "2016/1/28", "2016/1/29", "2016/1/30", "2016/1/31", "2016/2/1", "2016/2/2", "2016/2/3", "2016/2/4", "2016/2/5", "2016/2/6", "2016/2/7", "2016/2/13", "2016/2/14", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/21", "2016/2/25", "2016/2/26", "2016/2/27", "2016/2/28", "2016/3/1", "2016/3/2", "2016/3/3", "2016/3/4", "2016/3/5", "2016/3/6", "2016/3/8", "2016/3/9", "2016/3/10", "2016/3/11", "2016/3/12", "2016/3/13", "2016/3/15", "2016/3/16", "2016/3/17", "2016/3/18", "2016/3/19", "2016/3/20", "2016/3/22", "2016/3/23", "2016/3/24", "2016/3/25", "2016/3/26", "2016/3/27", "2016/3/29", "2016/3/30", "2016/3/31", "2016/4/1", "2016/4/2", "2016/4/3", "2016/4/6", "2016/4/7", "2016/4/8", "2016/4/9", "2016/4/10", "2016/4/12", "2016/4/13", "2016/4/14", "2016/4/15", "2016/4/16", "2016/4/17", "2016/4/19", "2016/4/20", "2016/4/21", "2016/4/22", "2016/4/23", "2016/4/24", "2016/4/26", "2016/4/30", "2016/11/27", "2016/12/2", "2016/12/4", "2016/12/6", "2016/12/7", "2016/12/8", "2016/12/9", "2016/12/10", "2016/12/11", "2016/12/13", "2016/12/14", "2016/12/15", "2016/12/16", "2016/12/17", "2016/12/18", "2016/12/20", "2016/12/21", "2016/12/22", "2016/12/23", "2016/12/24", "2016/12/25", "2016/12/27", "2016/12/28", "2016/12/29", "2016/12/30", "2016/12/31", "2017/1/1", "2017/1/3", "2017/1/4", "2017/1/5", "2017/1/6", "2017/1/7", "2017/1/8", "2017/1/10", "2017/1/11", "2017/1/12", "2017/1/13", "2017/1/14", "2017/1/15", "2017/1/17", "2017/1/18", "2017/1/19", "2017/1/20", "2017/1/21", "2017/1/22", "2017/1/24", "2017/1/25", "2017/1/26", "2017/1/27", "2017/2/2", "2017/2/3", "2017/2/4", "2017/2/7", "2017/2/8", "2017/2/9", "2017/2/10", "2017/2/11", "2017/2/14", "2017/2/15", "2017/2/16", "2017/2/17", "2017/2/18", "2017/2/19", "2017/2/21", "2017/2/22", "2017/2/23", "2017/2/24", "2017/2/25", "2017/2/26", "2017/2/28", "2017/3/1", "2017/3/2", "2017/3/3", "2017/3/4", "2017/3/5", "2017/3/7", "2017/3/8", "2017/3/9", "2017/3/10", "2017/3/11", "2017/3/12", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/26", "2017/3/28", "2017/3/29", "2017/3/30", "2017/3/31", "2017/4/1", "2017/4/2", "2017/4/3", "2017/4/6", "2017/4/7", "2017/4/8", "2017/4/9", "2017/4/11", "2017/4/12", "2017/4/13", "2017/4/14", "2017/4/15", "2017/4/16", "2017/4/18", "2017/4/19", "2017/4/20", "2017/4/21", "2017/4/22", "2017/4/23", "2017/4/25", "2017/4/26", "2017/4/27", "2017/4/28", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/3", "2017/5/4", "2017/5/5", "2017/5/6", "2017/5/7", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/17", "2017/5/21", "2017/5/24", "2017/5/28", "2017/11/18", "2017/11/19", "2017/11/24", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13", "2018/1/14", "2018/1/15"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [117.7, 129.5, 144.5, 141.8, 142.8, 138.1, 124.9, 120.6, 117.5, 104.9, 99, 85.4, 96.1, 96.7, 104.9, 109.1, 107.7, 101.5, 103.8, 111.2, 120.9, 124.6, 124.9, 113.9, 104.5, 107.4, 112.3, 122.3, 117.8, 112.2, 110.3, 115, 135.4, 147.1, 139.4, 145, 161.1, 164.8, 180.3, 182.4, 192.7, 182.7, 135.9, 105.6, 86.4, 76.9, 73.6, 69.7, 59.8, 65.4, 65.8, 53.3, 63.6, 49.1, 48.3, 57.9, 67.9, 61.6, 56.7, 54.5, 49.5, 51.4, 52, 43.9, 36, 40.3, 36.7, 41.6, 46.8, 46.9, 41.8, 38.4, 31.5, 33.7, 35, 42.1, 36.6, 42.9, 38.4, 60, 60, 60, 63, 60, 60, 55, 58.3, 109.5, 40, 52, 59.1, 73.6, 95.8, 60, 79.9, 66.2, 83.5, 73.3, 78.7, 71.2, 85.5, 82.1, 87.7, 67.5, 72.7, 73.7, 92.6, 82, 81.1, 82.8, 89.4, 93.6, 97.3, 92.7, 81.7, 82.6, 100.1, 101.6, 101, 109.9, 117.6, 119.6, 110.1, 104.7, 115.9, 95.2, 89.9, 91, 78.5, 116.1, 113.2, 113.1, 93.1, 89, 77.3, 61.1, 93.3, 89.9, 64.9, 79.1, 76.7, 80.8, 101.7, 110, 100.2, 106.1, 118.3, 87.2, 107.8, 110.4, 136.9, 119.4, 128.2, 146.6, 112.7, 137.7, 140.3, 110.9, 126.2, 120.7, 122.9, 134.3, 121.4, 152.9, 144.3, 126.2, 116.8, 104.8, 144.3, 136.5, 160.8, 151.4, 198.2, 190.1, 183.3, 156.9, 160.7, 167.1, 164, 153, 128.2, 106.9, 88.5, 89.2, 102.5, 106.5, 98.4, 90.2, 97.6, 101.4, 98.6, 91.7, 86.5, 83.7, 71, 59.6, 68.5, 83.8, 79.5, 74.5, 69.1, 69.4, 70.6, 69.2, 60.8, 44.2, 45, 61.1, 60.4, 52.7, 44.6, 41.1, 60.6, 84.5, 61.8, 69.5, 83.4, 74.6, 75.4, 93.8, 85.7, 90, 30, 90, 85, 129, 117.6, 106.2, 119.6, 94.3, 129, 110.1, 134.2, 121, 119.9, 120.7, 120.3, 140.5, 132, 126.4, 128.4, 133, 129.1, 108.4, 112.3, 121.6, 131.8, 136.6, 126.3, 124, 147.2, 127.4, 119.8, 130.8, 123.1, 112.5, 121.8, 127, 110.1, 126.4, 119.7, 147.3, 130.6, 132, 130, 141.8, 145.7, 174.9, 170, 162.6, 171.5, 174.7, 134.4, 109.5, 130, 112.7, 121.2, 121.2, 135.3, 151.3, 132.6, 139.9, 152.9, 149.8, 149.5, 138.1, 118.4, 106.9, 97.9, 105.8, 110, 115.4, 135.4, 128.1, 129, 116.3, 116.3, 119.5, 112.3, 95.8, 94.5, 103.3, 114.4, 113.2, 82.7, 88.9, 78.7, 82.7, 111.1, 92.5, 76.6, 76.4, 68.8, 78.3, 77, 74.6, 69.2, 79.1, 65.4, 67.5, 66.1, 69.8, 62.9, 58.8, 50.4, 59.4, 66.6, 42.8, 50.9, 68.8, 61, 70.8, 74.1, 69.4, 90.1, 53, 52.8, 45.2, 82.3, 69.8, 58.4, 40.4, 241.3, 70, 100.2, 128.2, 72.2, 112.1, 259.3, 53.7, 75.1, 55.1, 57, 68.9, 160, 50.2, 138, 142.9, 79, 50.5, 43, 123, 120, 110, 129, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 115, 114.3, 113.6, 112.9, 112.3, 111.7, 111.2, 110.7, 110.2, 109.7, 109.3, 108.9, 108.5, 108.1, 107.7, 107.4, 107.1, 106.8, 106.5, 106.2, 105.9, 105.7, 105.5, 105.3, 105, 104.8, 104.7, 104.5, 104.3, 104.2, 104, 103.9, 103.7, 103.6, 103.5, 103.4, 103.2, 103.1, 103, 102.9, 102.9, 102.8, 102.7, 102.6, 102.5, 102.5, 102.4, 102.4, 102.3, 102.2],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 126.4, 126.6, 126.6, 126.6, 126.6, 126.5, 126.3, 126.2, 126, 125.8, 125.6, 125.4, 125.2, 125, 124.8, 124.6, 124.4, 124.2, 124, 123.8, 123.7, 123.5, 123.3, 123.1, 123, 122.8, 122.7, 122.5, 122.4, 122.3, 122.1, 122, 121.9, 121.8, 121.7, 121.6, 121.5, 121.4, 121.3, 121.2, 121.2, 121.1, 121, 120.9, 120.9, 120.8, 120.8, 120.7, 120.6, 120.6],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 103.5, 101.9, 100.5, 99.2, 98.1, 97, 96.1, 95.2, 94.4, 93.6, 92.9, 92.3, 91.7, 91.2, 90.7, 90.2, 89.7, 89.3, 88.9, 88.6, 88.2, 87.9, 87.6, 87.4, 87.1, 86.9, 86.6, 86.4, 86.2, 86, 85.8, 85.7, 85.5, 85.4, 85.2, 85.1, 85, 84.9, 84.8, 84.7, 84.6, 84.5, 84.4, 84.3, 84.2, 84.1, 84.1, 84, 84, 83.9],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });


                /**
                  西瓜
                **/
                $( "#a2_6" ).click(function() {
                  var myChart = ec.init(document.getElementById('chart2_6')); 
                  var option = {
                      tooltip: {
                          show: true
                      },
                      toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                      },
                      title : {
                          text: '西瓜',
                          subtext: '近期價錢趨勢'
                      },
                      legend: {
                          data:['平均價','預測價','下界','上界']
                      },
                      dataZoom : {
                          show : true,
                          realtime: true,
                          start : 0,
                          end : 100
                      },
                      xAxis : [
                          {
                              type : 'category',
                              data : ["2015/1/1", "2015/1/3", "2015/1/7", "2015/1/9", "2015/1/14", "2015/1/18", "2015/1/22", "2015/1/24", "2015/1/25", "2015/1/28", "2015/2/1", "2015/2/3", "2015/2/4", "2015/2/8", "2015/2/10", "2015/2/12", "2015/2/13", "2015/2/14", "2015/2/17", "2015/2/25", "2015/3/1", "2015/3/3", "2015/3/6", "2015/3/10", "2015/3/11", "2015/3/12", "2015/3/13", "2015/3/15", "2015/3/17", "2015/3/19", "2015/3/22", "2015/3/24", "2015/3/25", "2015/4/1", "2015/4/2", "2015/4/3", "2015/4/4", "2015/4/7", "2015/4/8", "2015/4/9", "2015/4/10", "2015/4/12", "2015/4/14", "2015/4/15", "2015/4/16", "2015/4/17", "2015/4/18", "2015/4/19", "2015/4/21", "2015/4/22", "2015/4/23", "2015/4/24", "2015/4/25", "2015/4/26", "2015/4/28", "2015/4/29", "2015/4/30", "2015/5/1", "2015/5/2", "2015/5/3", "2015/5/5", "2015/5/6", "2015/5/7", "2015/5/8", "2015/5/9", "2015/5/10", "2015/5/12", "2015/5/13", "2015/5/14", "2015/5/15", "2015/5/16", "2015/5/17", "2015/5/19", "2015/5/20", "2015/5/21", "2015/5/22", "2015/5/23", "2015/5/24", "2015/5/26", "2015/5/27", "2015/5/28", "2015/5/29", "2015/5/30", "2015/5/31", "2015/6/2", "2015/6/3", "2015/6/4", "2015/6/5", "2015/6/6", "2015/6/7", "2015/6/9", "2015/6/10", "2015/6/11", "2015/6/12", "2015/6/13", "2015/6/14", "2015/6/16", "2015/6/17", "2015/6/18", "2015/6/19", "2015/6/20", "2015/6/23", "2015/6/24", "2015/6/25", "2015/6/26", "2015/6/27", "2015/6/28", "2015/6/30", "2015/7/1", "2015/7/2", "2015/7/3", "2015/7/4", "2015/7/7", "2015/7/8", "2015/7/9", "2015/7/10", "2015/7/11", "2015/7/12", "2015/7/14", "2015/7/15", "2015/7/16", "2015/7/17", "2015/7/18", "2015/7/19", "2015/7/21", "2015/7/22", "2015/7/23", "2015/7/24", "2015/7/25", "2015/7/26", "2015/7/29", "2015/7/31", "2015/8/1", "2015/8/2", "2015/8/4", "2015/8/5", "2015/8/6", "2015/8/7", "2015/8/8", "2015/8/11", "2015/8/12", "2015/8/13", "2015/8/14", "2015/8/16", "2015/8/19", "2015/8/20", "2015/8/21", "2015/8/26", "2015/9/1", "2015/9/5", "2015/9/8", "2015/9/9", "2015/9/23", "2015/9/26", "2015/10/9", "2015/10/10", "2015/10/14", "2015/10/17", "2015/10/20", "2015/10/21", "2015/10/24", "2015/11/3", "2015/11/10", "2015/11/13", "2015/11/14", "2015/11/19", "2015/11/20", "2015/11/25", "2015/11/26", "2015/11/27", "2015/11/29", "2015/12/2", "2015/12/9", "2015/12/15", "2015/12/17", "2015/12/23", "2015/12/24", "2016/1/2", "2016/1/14", "2016/1/20", "2016/1/22", "2016/1/28", "2016/1/31", "2016/2/1", "2016/2/13", "2016/2/17", "2016/2/18", "2016/2/19", "2016/2/20", "2016/2/26", "2016/2/28", "2016/3/3", "2016/3/10", "2016/3/13", "2016/4/1", "2016/4/6", "2016/4/20", "2016/4/21", "2016/4/24", "2016/4/26", "2016/4/27", "2016/4/28", "2016/4/30", "2016/5/1", "2016/5/3", "2016/5/5", "2016/5/6", "2016/5/8", "2016/5/11", "2016/5/14", "2016/5/17", "2016/5/18", "2016/5/19", "2016/5/20", "2016/5/21", "2016/5/22", "2016/5/24", "2016/5/25", "2016/5/26", "2016/5/27", "2016/5/28", "2016/5/29", "2016/5/31", "2016/6/1", "2016/6/2", "2016/6/3", "2016/6/4", "2016/6/5", "2016/6/7", "2016/6/8", "2016/6/9", "2016/6/12", "2016/6/14", "2016/6/15", "2016/6/16", "2016/6/17", "2016/6/18", "2016/6/19", "2016/6/21", "2016/6/22", "2016/6/23", "2016/6/24", "2016/6/25", "2016/6/26", "2016/6/28", "2016/6/29", "2016/6/30", "2016/7/1", "2016/7/2", "2016/7/3", "2016/7/5", "2016/7/6", "2016/7/7", "2016/7/8", "2016/7/13", "2016/7/14", "2016/7/15", "2016/7/16", "2016/7/20", "2016/7/22", "2016/7/23", "2016/7/24", "2016/7/26", "2016/7/27", "2016/7/28", "2016/7/29", "2016/7/30", "2016/7/31", "2016/8/2", "2016/8/3", "2016/8/4", "2016/8/5", "2016/8/6", "2016/8/7", "2016/8/10", "2016/8/11", "2016/8/14", "2016/8/16", "2016/8/17", "2016/8/20", "2016/8/23", "2016/8/30", "2016/9/4", "2016/9/7", "2016/9/8", "2016/9/9", "2016/9/11", "2016/9/13", "2016/9/14", "2016/9/20", "2016/9/22", "2016/9/24", "2016/9/25", "2016/10/9", "2016/10/13", "2016/12/6", "2016/12/21", "2016/12/24", "2016/12/30", "2017/1/6", "2017/1/19", "2017/1/24", "2017/2/7", "2017/2/15", "2017/2/21", "2017/2/28", "2017/3/5", "2017/3/10", "2017/3/14", "2017/3/15", "2017/3/16", "2017/3/17", "2017/3/18", "2017/3/19", "2017/3/21", "2017/3/22", "2017/3/23", "2017/3/24", "2017/3/25", "2017/3/28", "2017/4/1", "2017/4/2", "2017/4/6", "2017/4/8", "2017/4/11", "2017/4/12", "2017/4/15", "2017/4/19", "2017/4/20", "2017/4/21", "2017/4/22", "2017/4/26", "2017/4/27", "2017/4/28", "2017/4/29", "2017/4/30", "2017/5/2", "2017/5/4", "2017/5/5", "2017/5/6", "2017/5/9", "2017/5/10", "2017/5/11", "2017/5/12", "2017/5/13", "2017/5/14", "2017/5/16", "2017/5/17", "2017/5/18", "2017/5/19", "2017/5/20", "2017/5/21", "2017/5/23", "2017/5/24", "2017/5/25", "2017/5/26", "2017/5/27", "2017/5/28", "2017/5/29", "2017/5/30", "2017/6/2", "2017/6/3", "2017/6/4", "2017/6/6", "2017/6/7", "2017/6/8", "2017/6/9", "2017/6/10", "2017/6/11", "2017/6/13", "2017/6/14", "2017/6/15", "2017/6/16", "2017/6/18", "2017/6/23", "2017/6/24", "2017/6/25", "2017/6/27", "2017/6/28", "2017/6/29", "2017/6/30", "2017/7/1", "2017/7/4", "2017/7/5", "2017/7/6", "2017/7/7", "2017/7/9", "2017/7/11", "2017/7/12", "2017/7/14", "2017/7/15", "2017/7/18", "2017/7/19", "2017/7/21", "2017/7/22", "2017/7/23", "2017/7/25", "2017/7/26", "2017/7/27", "2017/7/30", "2017/8/2", "2017/8/3", "2017/8/6", "2017/8/8", "2017/8/9", "2017/8/10", "2017/8/11", "2017/8/13", "2017/8/15", "2017/8/16", "2017/8/17", "2017/8/19", "2017/8/20", "2017/8/22", "2017/8/23", "2017/8/24", "2017/8/25", "2017/8/26", "2017/8/27", "2017/8/29", "2017/8/30", "2017/8/31", "2017/9/1", "2017/9/2", "2017/9/4", "2017/9/8", "2017/9/9", "2017/9/10", "2017/9/12", "2017/9/13", "2017/9/14", "2017/9/20", "2017/9/21", "2017/9/29", "2017/10/1", "2017/10/7", "2017/10/8", "2017/10/10", "2017/10/11", "2017/10/15", "2017/10/18", "2017/10/29", "2017/10/31", "2017/11/4", "2017/11/7", "2017/11/9", "2017/11/14", "2017/11/19", "2017/11/22", "2017/11/24", "2017/11/25", "2017/11/26", "2017/11/27", "2017/11/28", "2017/11/29", "2017/11/30", "2017/12/1", "2017/12/2", "2017/12/3", "2017/12/4", "2017/12/5", "2017/12/6", "2017/12/7", "2017/12/8", "2017/12/9", "2017/12/10", "2017/12/11", "2017/12/12", "2017/12/13", "2017/12/14", "2017/12/15", "2017/12/16", "2017/12/17", "2017/12/18", "2017/12/19", "2017/12/20", "2017/12/21", "2017/12/22", "2017/12/23", "2017/12/24", "2017/12/25", "2017/12/26", "2017/12/27", "2017/12/28", "2017/12/29", "2017/12/30", "2017/12/31", "2018/1/1", "2018/1/2", "2018/1/3", "2018/1/4", "2018/1/5", "2018/1/6", "2018/1/7", "2018/1/8", "2018/1/9", "2018/1/10", "2018/1/11", "2018/1/12", "2018/1/13", "2018/1/14", "2018/1/15"]
                          }
                      ],
                      yAxis : [
                          {
                              type : 'value'
                          }
                      ],
                      series : [
                          {
                              "name":"平均價",
                              "type":'line',
                              "data": [10, 10, 8, 10, 10, 9.3, 10, 10, 10, 10, 22.5, 19, 19, 18, 17.2, 22, 18, 18, 18, 15, 15, 12, 15, 12, 12, 15, 15, 15, 15, 15, 5, 15, 14, 10, 12.1, 11.2, 11.1, 9.8, 9.9, 10.9, 9.4, 9.9, 7.2, 10.1, 9, 10.5, 10, 10, 9.5, 13, 10, 13, 9.5, 9.5, 9, 11.2, 9.7, 12.9, 10.1, 11.7, 10, 11.4, 11.1, 9.9, 9.9, 9.7, 9.9, 12.7, 10.1, 12.7, 10.5, 11.8, 10.6, 10.2, 11.3, 10.5, 12.2, 10.1, 10.5, 12.6, 10.3, 9.5, 8.9, 9.2, 10.6, 9.2, 10.3, 9, 11.1, 11, 9.4, 10, 9.2, 8.4, 11.3, 10.9, 11.1, 9.7, 11.5, 11.4, 8.1, 11.5, 13.5, 13, 13, 13, 13, 13, 13, 18, 13.8, 15, 14.3, 15, 14, 14, 14, 20, 14.8, 14, 14, 14, 14, 14, 14, 14.1, 12, 9, 12, 12, 11.6, 11.9, 12, 12, 11.2, 11.5, 11.5, 11.3, 7, 9.2, 11.4, 11.6, 12.9, 12.9, 12.5, 14, 12.5, 12.5, 12.5, 11.8, 12.5, 12.5, 9, 15, 20, 20, 20, 20, 20, 14, 14, 12.5, 12.5, 11.5, 20, 20, 10, 10, 15, 10, 13, 8.5, 9, 8.5, 8.5, 10, 8.5, 8, 8, 8, 8, 12.5, 12.5, 12.5, 12.5, 12.5, 12.5, 11.5, 11, 12.5, 12.5, 10.5, 15, 10.5, 10, 9.6, 14, 16, 20, 16, 17.8, 21.3, 16, 15, 15.9, 14, 18, 18.5, 16.1, 19.1, 19, 19.5, 18.4, 18.9, 18.5, 17.4, 18.8, 18.7, 19.1, 21.4, 15.1, 16, 15.5, 13.4, 13.3, 12.6, 11.1, 11.3, 11.1, 10.9, 11.2, 10.6, 10.3, 9.9, 10.6, 10.9, 7.5, 10.4, 10.1, 10.7, 9.5, 10, 10, 10, 11.5, 11.5, 11.5, 14, 14, 14, 14, 14, 14, 14, 14, 14, 14, 14, 15, 9, 10, 12.7, 15, 14, 14, 14, 15, 14, 14, 14, 30, 15, 17, 18, 17, 15, 17, 15.7, 15.1, 17, 17, 15, 15, 15, 15, 15, 5.6, 11.5, 11.4, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 20, 20, 20, 20, 20, 20, 17, 17, 17, 17, 11.5, 11.5, 11.5, 15, 7, 11.4, 7.6, 7.5, 9.4, 8.5, 8.7, 9.1, 3.4, 2, 20.4, 16, 9.5, 10.4, 14.2, 13, 13, 14.4, 13, 13, 13, 16, 14.6, 13, 13, 15.6, 6, 13, 13, 16, 13, 15, 13, 15, 13.1, 12.6, 14.9, 15.5, 12.2, 12.9, 15.7, 13.9, 16.5, 14.3, 15.5, 13.3, 15.3, 15.3, 12.2, 12.5, 5.3, 14.9, 12.6, 13, 14.6, 13.4, 14.7, 16, 12.7, 12.7, 13.9, 13, 14, 16, 15, 13.5, 13.5, 13.5, 13.5, 20, 19, 20, 15.6, 13.7, 15, 15, 15.1, 15.7, 16.5, 17, 12, 19.3, 19.5, 20.2, 21.1, 21.5, 21.4, 21.1, 20, 16, 15, 20, 20, 21.5, 21.5, 15, 18.9, 18.9, 22, 13.6, 15, 13.5, 14, 18, 13.6, 13.6, 7.2, 10.7, 12.3, 6, 14, 10.5, 10.7, 5.8, 10.4, 10.7, 10.7, 11, 10.6, 10, 12.9, 13.1, 13.1, 13.1, 33, 18, 18, 17.5, 15.8, 11, 21, 18, 20, 14, 18, 14, 28, 14, 14, 14, 14, 10, 18, "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"預測價",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 13.7, 16.1, 13.6, 16, 13.7, 16, 13.7, 15.9, 13.8, 15.9, 13.8, 15.8, 13.9, 15.8, 13.9, 15.7, 13.9, 15.7, 14, 15.7, 14, 15.6, 14.1, 15.6, 14.1, 15.5, 14.1, 15.5, 14.2, 15.5, 14.2, 15.4, 14.2, 15.4, 14.2, 15.4, 14.3, 15.4, 14.3, 15.3, 14.3, 15.3, 14.3, 15.3, 14.4, 15.3, 14.4, 15.3, 14.4, 15.2],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}},}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"上界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 15.2, 17.7, 15.3, 17.8, 15.5, 17.9, 15.7, 18, 15.9, 18.1, 16.1, 18.2, 16.3, 18.3, 16.5, 18.4, 16.6, 18.5, 16.8, 18.5, 17, 18.6, 17.1, 18.7, 17.2, 18.7, 17.4, 18.8, 17.5, 18.9, 17.6, 18.9, 17.7, 19, 17.9, 19, 18, 19.1, 18.1, 19.2, 18.2, 19.2, 18.3, 19.3, 18.4, 19.3, 18.5, 19.4, 18.6, 19.4],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          },
                          {
                              "name":"下界",
                              "type":'line',
                              "data": ["-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", 12.3, 14.5, 11.9, 14.3, 11.8, 14, 11.7, 13.8, 11.6, 13.6, 11.5, 13.4, 11.4, 13.3, 11.3, 13.1, 11.2, 12.9, 11.2, 12.8, 11.1, 12.6, 11, 12.5, 11, 12.4, 10.9, 12.2, 10.8, 12.1, 10.8, 12, 10.7, 11.9, 10.6, 11.7, 10.6, 11.6, 10.5, 11.5, 10.5, 11.4, 10.4, 11.3, 10.3, 11.2, 10.3, 11.1, 10.2, 11],
                              markPoint : {
                                  data : [
                                      // 纵轴，默认
                                      {type : 'max', name: '最大值',symbol: 'pin', itemStyle:{normal:{color:'#E74C3C',label:{position:'inside'}}}},
                                      {type : 'min', name: '最小值',symbol: 'pin', itemStyle:{normal:{color:'#1ABB9C',label:{position:'inside'}}}}
                                  ]
                              }
                          }
                      ]
                  };

                  // 为echarts对象加载数据 
                  myChart.setOption(option); 

                });

                
            }
        );

      

    </script>
	
  </body>
</html>
