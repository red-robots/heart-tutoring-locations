<?php /* Bottom Content */ 
  $bottom_title = get_field("con_section_title","option");
  $bottom_data = get_field("con_columns","option");
  if($bottom_data) { ?>
  <section class="concept-bottom-section">
    <div class="contentWrap">
      <?php if ($bottom_title) { ?>
      <h2 class="stitle"><?php echo $bottom_title ?></h2> 
      <?php } ?>
      
      <div class="flexwrap bcolumns">
      <?php foreach ($bottom_data as $b) { 
        $title = $b['title'];
        $text = $b['text'];
        $buttonName = $b['button_name'];
        $buttonLink = $b['button_link'];
        $buttonTarget = "_self";
        if($buttonLink) {
          $bLink = parse_external_url($buttonLink);
          $buttonTarget = $bLink['target'];
        }
        ?>
        <div class="bcol">
          <div class="wrap">
            <?php if ($title) { ?>
            <h3 class="title"><?php echo $title ?></h3>
            <?php } ?>
            <?php if ($text) { ?>
            <div class="text"><?php echo email_obfuscator($text) ?></div>
            <?php } ?>
            <?php if ($buttonName && $buttonLink) { ?>
            <div class="button"><a href="<?php echo $buttonLink ?>" target="<?php echo $buttonTarget ?>" class="theme-btn2"><?php echo $buttonName ?></a></div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </section>
<?php } ?>

