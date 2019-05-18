<?define ("PAGE", "docs-page");?>
<?include($_SERVER["DOCKER_ROOT"]."/header.php");?>
<?require_once ($_SERVER["DOCKER_ROOT"]."/Parsedown.php")?>

	<div class="col-md-3 d-none d-md-flex left-side-menu">
		<div class="dropdown-menu show">
		<?
			left_side_menu("docs");
		?>
		</div>
	</div>
	<div class="col-12 col-md-9 markdown-body">
		<?
		$Parsedown = new Parsedown();
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["SETTINGS"]['github_docs_path'].$_GET['page'].".md")));	
		?>
	</div>

<?include($_SERVER["DOCKER_ROOT"]."/footer.php");?>