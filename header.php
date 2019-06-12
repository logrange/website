<?
	$GLOBALS["SETTINGS"] = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/settings.ini", true);
	define("SITE_PATH", getFullServerName());

	function left_side_menu($type)
	{
		$c = 1; $cm = 1; //counters of active menu section item
		$menu = [];
		foreach ($GLOBALS["SETTINGS"] as $section_name=>$data)
		{
			if (preg_match_all("/([^.]+)\.([^.]+)/", $section_name, $section_name))
			{
				$menu[$section_name[1][0]][$section_name[2][0]] = []; // $section_name[1][0] - page-type; $section_name[2][0] - section of menu
				foreach ($data as $title=>$link)
				{
					if ( substr($link, 0, 1) == "/" ) $link = $_SERVER["DOCUMENT_ROOT"].$link; //if relative path - doc is on server
					$root_link = array_shift(explode('#',$link));
					$link_parts = explode(".", array_pop(explode("/",$link)));
					$anchor = explode("#", $link_parts[1]);
					$anchor =  (count($anchor) == 2) ? "#".$anchor[1] : "";
					$page = $link_parts[0];
					$GLOBALS["MENU"]["LINKS"][$section_name[1][0]][$page] = $root_link;
					$menu[$section_name[1][0]][$section_name[2][0]][$title]['link'] = $page.".html".$anchor;
					$isCurrentSection = strpos($_SERVER["REQUEST_URI"], "/".$section_name[1][0]."/") === 0;
					if ($isCurrentSection)
					{
						if ( !isset($_GET['page']))
							$_GET['page'] = $page;
						if ($page == $_GET['page'])
						{
							$activeMenuItem = [ $c, $cm ];
						}
					}
				}
			if ($section_name[1][0] == $type) $c++;
			if ($type == "mobile") $cm++;
			}
		}
		
		
		if ($type != "mobile")
		{
			$c = 1;
		
	?><div class="d-none d-md-block left-side-menu col-md-3 pr-0">
		<div class="search-form-container">
			<form action="<?=SITE_PATH?>search/">
				<div class="input-group">
				  <input type="text" class="form-control" aria-label="Search" placeholder="Search in <?=PAGE?>">
				  <div class="input-group-append">
					<span class="input-group-text"><i class="fa fa-zoom"></i></span>
				  </div>
				</div>
			</form>
		</div>	
	
		<div class="left-side-menu-items"><?
		
			foreach ($menu[$type] as $title=>$menu_data)
			{
				if ($title):
				?><h6 class="dropdown-header<?=$activeMenuItem[0] == $c ? " active" : ""?>"><?=$title?></h6><div><?
				$c++;
				endif;
				foreach ($menu_data as $title=>$data)
				{
					?><a class="dropdown-item" href="<?=SITE_PATH?><?=$type?>/<?= $data["link"] ?>"><?=$title?></a><?
				}
				?></div><?
			}
		
		?></div>
	</div><?
		}
		
		if ($type == "mobile") //mobile menu
		{
		$cm = 1;
			?>
			<div class="w-100 menu-shadowed mt-3 pb-3">
				<div class="search-form-container">
					<form action="<?=SITE_PATH?>search/">
						<div class="input-group">
						  <input type="text" class="form-control" aria-label="Search" placeholder="Search in <?=PAGE?>">
						  <div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-zoom"></i></span>
						  </div>
						</div>
					</form>
				</div>	
			<?
			foreach ($menu  as $page => $page_menu_data)
			{
					$isCurrentSection = strpos($_SERVER["REQUEST_URI"], "/".$page."/") === 0;
					?>
					<h6 class="level-1<?=$isCurrentSection ? " active" : ""?>"><?=$page?></h6>
					<div class="level-1-submenu" style="display:none"><?
						foreach ($page_menu_data as $title=>$menu_data)
						{
							if ($title):
							?>
							<h6 class="level-2<?=$isCurrentSection && ($activeMenuItem[1] === $cm) ? " active" : ""?>"><?=$title?></h6><!--<?=$cm?>-->
							<div class="level-2-submenu"><?
							$cm++;
							endif;
							foreach ($menu_data as $title=>$data)
							{
								?><a class="dropdown-item" href="<?=SITE_PATH?><?=$page?>/<?= $data["link"] ?>"><?=$title?></a><?
							}
							?></div><?
						}
					?></div>
					<?
			}
			?></div><?
		}
		?>
		<script>//setting active menu
			$("a[href='" + document.location.href +"']").addClass("active");
			$(".page-title-content").html($("a[href='" + document.location.href +"']").html());
		</script>
		<?
	}
	function prepare_md($txt) {
		$txt = preg_replace("/\.md([^a-zA-Z])/",'.html$1',$txt);
		$txt = preg_replace("/---\ntitle:(.+)/i","<h2 class=\"markdown-title\">$1</h2>",$txt);
		$txt = preg_replace("/author:(.+)\n---/i","<h2 class=\"markdown-author\">$1</h2>",$txt);
		return $txt;
	}

	function getFullServerName()
	{
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5))=='https'? 'https' : 'http';
		if ($_SERVER["SERVER_PORT"] == 443) {
			$protocol = 'https';
		} elseif (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
			$protocol = 'https';
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
			$protocol = 'https';
		}
			
		return $protocol."://".$_SERVER["HTTP_HOST"]."/";
	}
	
	if (PAGE != "front") {
		require_once ($_SERVER["DOCUMENT_ROOT"]."/Parsedown.php");
		$Parsedown = new Parsedown();
	}


		
?>

<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140973891-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-140973891-1');
	</script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Logrange Streaming Database.">
	<title>Logrange Streaming Database.</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=SITE_PATH?>style.css">
	<link rel="stylesheet" href="<?=SITE_PATH?>style_mobile.css">
	<link rel="stylesheet" href="<?=SITE_PATH?>style_markdown.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="<?=PAGE."-page"?>">
	<div class="screen-shadow"></div>
	<?include("nav.php");?>
	<?if (PAGE != "front"):?>
	<div class="container-fluid page-title-container">
		<div class="row">
			<div class="col-12 col-md-9 offset-md-3 page-title">
				<div class="page-title-content">
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid content <?=PAGE."-page"?>">
		<div class="row <?=PAGE."-page"?>">
	<?else: //front-page?>
	<div class="container content px-0 d-table <?=PAGE."-page"?>">
		<div class="row d-table-row <?=PAGE."-page"?>">		
		
		
		
	<?endif;?>
		
		