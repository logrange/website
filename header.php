<?
	$GLOBALS["SETTINGS"] = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/settings.ini", true);
	define("SITE_PATH", getFullServerName());
	

	function left_side_menu($type)
	{
		$c = 1;
		$menu = [];
		foreach ($GLOBALS["SETTINGS"] as $section_name=>$data)
		{
			if (preg_match_all("/([^.]+)\.([^.]+)/",$section_name,$section_name))
			{
				$menu[$section_name[1][0]][$section_name[2][0]] = []; // $section_name[1][0] - page-type; $section_name[2][0] - section of menu
				foreach ($data as $title=>$link)
				{
					if ( substr($link, 0, 1) == "/" ) $link = $_SERVER["DOCUMENT_ROOT"]."/".$link; //if relative path - doc is on server
					$page = array_shift(explode(".", array_pop(explode("/",$link))));
					$GLOBALS["MENU"]["LINKS"][$section_name[1][0]][$page] = $link;
					$menu[$section_name[1][0]][$section_name[2][0]][$title]['link'] = $page.".html";
					if ( !isset($_GET['page']) && ($section_name[1][0] == $type) )
						$_GET['page'] = $page;
					if ($page == $_GET['page'])
					{
						$isCurrentSection = strpos($_SERVER["REQUEST_URI"], "/".$section_name[1][0]."/") !== false;
						$menu[$section_name[1][0]][$section_name[2][0]][$title]['active'] = true;
						if ($isCurrentSection) $activeMenuItem = $c;
					}
				}
			if ($section_name[1][0] == $type) $c++;
			}
		}
		
		$c = 1;
		
		if ($type != "mobile")
		{
		
	?><div class="col-md-3 d-none d-md-flex left-side-menu">
		<div class="w-100"><?
		
		foreach ($menu[$type] as $title=>$menu_data)
		{
			if ($title):
			?><h6 class="dropdown-header<?=$activeMenuItem == $c ? " active" : ""?>"><?=$title?></h6><div><?
			$c++;
			endif;
			foreach ($menu_data as $title=>$data)
			{
				?><a class="dropdown-item<?= $data["active"] ? ' active' : "" ?>" href="<?=SITE_PATH?><?=$type?>/<?= $data["link"] ?>"><?=$title?></a><?
			}
			?></div><?
		}
		
		?></div>
	</div><?
		}
		
		$c = 1;
		if ($type == "mobile") //mobile menu
		{
			?>
			<div class="w-100 menu-shadowed mt-3 pb-3"><?
			foreach ($menu  as $page => $page_menu_data)
			{
					$isCurrentSection = strpos($_SERVER["REQUEST_URI"], "/".$page."/") !== false;
					?>
					<h6 class="level-1<?=$isCurrentSection ? " active" : ""?>"><?=$page?></h6>
					<div class="level-1-submenu" style="display:none"><?
						foreach ($page_menu_data as $title=>$menu_data)
						{
							if ($title):
							?>
							<hr>
							<h6 class="level-2<?=$isCurrentSection && ($activeMenuItem === $c) ? " active" : ""?>"><?=$title?></h6><!--<?=$c?>-->
							<div class="level-2-submenu"><?
							if ($isCurrentSection) $c++;
							endif;
							foreach ($menu_data as $title=>$data)
							{
								?><a class="dropdown-item<?= $data["active"] ? ' active' : "" ?>" href="<?=SITE_PATH?><?=$page?>/<?= $data["link"] ?>"><?=$title?></a><?
							}
							?></div><?
						}
					?></div>
					<hr><?
			}
			?></div><?
		}
		
	}
	function prepare_md($txt) {
		$txt = preg_replace("/\.md([^a-zA-Z])/",'.html$1',$txt);
		$txt = preg_replace("/---\r\ntitle: (.+)/i","<h2 class=\"markdown-title\">$1</h2>",$txt);
		$txt = preg_replace("/author: (.+)\r\n---/i","<h2 class=\"markdown-author\">$1</h2>",$txt);
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
	
	if (PAGE != "front-page") {
		require_once ($_SERVER["DOCUMENT_ROOT"]."/Parsedown.php");
		$Parsedown = new Parsedown();
	}


		
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Logrange Streaming Database.">
	<title>Logrange Streaming Database.</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=SITE_PATH?>style.css">
	<link rel="stylesheet" href="<?=SITE_PATH?>style_mobile.css">
	<link rel="stylesheet" href="<?=SITE_PATH?>style_markdown.css">
</head>

<body class="<?=PAGE?>">
	<div class="screen-shadow"></div>
	<?include("nav.php");?>
	<div class="container content px-0 <?=PAGE?>">
		<div class="row <?=PAGE?>">
		
		