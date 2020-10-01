<?php 
    $side_bars = 
    array(
      array(
        "id"=>"home",
        "text"=>"Home",
        "icon"=>"fa-home",
        "url"=>"/",
        "role_id"=> 1,
        "child"=>"",
      ),
      array(
        "id"=>"admin",
        "text"=>"Admin panel",
        "icon"=>"fa-user-o",
        "url"=>"#",
        "role_id"=> 2,
        "child"=>array(
          array(
            "id"=>"books",
            "text"=>"Books",
            "icon"=>"fa-book",
            "url"=>"/admin/books",
          ),
          array(
            "id"=>"tags",
            "text"=>"Tags",
            "icon"=>"fa-tag",
            "url"=>"/admin/tags",
          ),
          array(
            "id"=>"racks",
            "text"=>"Racks",
            "icon"=>"fa-archive",
            "url"=>"/admin/racks",
          ),
          array(
            "id"=>"publisher",
            "text"=>"Publisher",
            "icon"=>"fa-industry",
            "url"=>"/admin/publisher",
          ),
          array(
            "id"=>"types",
            "text"=>"Types",
            "icon"=>"fa-list",
            "url"=>"/admin/types",
          ),
        ),
      ),
    );
    ?>

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name"><?php echo $_SESSION['user']['name']; ?></p>
      <p class="app-sidebar__user-designation">Frontend Developer</p>
    </div>
  </div>
  <ul class="app-menu" id="admin_sidebar">
    <?php 
        $url = '//' . $_SERVER['SERVER_NAME'] . strtok($_SERVER['REQUEST_URI'], "?");
        foreach($side_bars as $sidebar){
         $toggle = ""; $toggle_class=""; $arrow_indicator="";
          $child_text = ''; $expanded = ''; $active = '';

          if(strpos($url, $sidebar['id']) !== false){
            $expanded = 'is-expanded';
          }

          if(!empty($sidebar['child'])){
            $child_text .= '<ul class="treeview-menu">';
            $toggle = 'data-toggle="treeview"';
            $toggle_class = "treeview";
            $arrow_indicator = '<i class="treeview-indicator fa fa-angle-right"></i>';
            foreach($sidebar['child'] as $child){
              if(strpos($url, $child['url']) !== false){
                $active = 'active';
              }else{
                $active = '';
              }

              $child_text .= '
                <li>
                <a id="'.$sidebar['id'].'_'.$child['id'].'" class="treeview-item '.$active.'" href="'.$child['url'].'"><i class="icon fa fa-circle-o"></i>'.$child['text'].'</a></li>
              ';
            }
            $child_text .= '</ul>';
          }

          if(strtok($_SERVER['REQUEST_URI'], "?") == '/' && $sidebar['id'] == 'home'){
            $active = 'active';
          }
          
          if($sidebar['role_id'] <= $_SESSION['user']['role_id']){
              echo 
            '<li class="'.$toggle_class.' '.$expanded.'">
              <a class="app-menu__item '.$active.'" id="'.$sidebar['id'].'" href="'.$sidebar['url'].'" '.$toggle.'>
                  <i class="app-menu__icon fa '.$sidebar['icon'].'"></i><span class="app-menu__label">'.$sidebar['text'].'</span>
                  '.$arrow_indicator.'
              </a>'.$child_text.'
            </li>';
          }
        }
     ?>
  </ul>
</aside>