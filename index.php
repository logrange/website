<?define ("PAGE", "front-page");?>
<?checkFeedback();?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>

<div class="front-page-intro-block">
<h1>Logrange</h1>
<h2>streaming database</h2>
<p>Logrange is highly performant streaming database for aggregating data like application logs, system metrics, audit logs etc. from thousands of sources.</p>
<div class="button-container">
	<a href="#get-logrange" class="btn btn-logrange btn-logrange-primary d-inline-block mr-3 float-left smooth-scroll">Get started</a>
	<a href="https://github.com/logrange/logrange" class="btn btn-logrange btn-logrange-outline d-inline-block float-left"><div class="github-logo non-mobile-only"></div>View on github</a>
</div>
</div>


</div><?//end of intro-block-container?>
<div class="container"><?//and new container and raw?>
	<div class="row working-with-streams-container position-relative">
	<div class="working-with-streams text-center px-5">
		<h2>Designed for working with streams</h2>
		<div class="row mx-0 non-mobile-only">
			<div class="col-12 col-sm-6 col-lg-4 px-5 text-left">
			<img src="<?=SITE_PATH?>images/working/1.svg">
			<h4>Highly performant</h4><p>
Access to all saved data at any time, 
no matter how big the stored data is. Logrange is able to save millions of records per second.</p>			
			
			</div>
			<div class="col-12 col-sm-6 col-lg-4 px-5 text-left">
			<img src="<?=SITE_PATH?>images/working/2.svg">
			<h4>Scalable</h4><p>
By data - accepts thousands data sources. Logrange HA cluster allows to save more data and serve more client requests.</p>
			</div>
			<div class="col-12 col-sm-6 col-lg-4 px-5 text-left">
			<img src="<?=SITE_PATH?>images/working/3.svg">
			<h4>Open Source</h4><p>
Written entirely in Go, Logrange is available under the Apache 2.0 license for easy adoption.  Run it yourself, or use pre-build installations.</p>			
			
			</div>
			<div class="col-12 col-sm-6 col-lg-4 px-5 text-left">
			<img src="<?=SITE_PATH?>images/working/4.svg">
			<h4>Secure</h4><p>
The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>			
			
			</div>
			<div class="col-12 col-sm-6 col-lg-4 px-5 text-left">
			<img src="<?=SITE_PATH?>images/working/5.svg">
			<h4>Aggregate Data from Everywhere</h4><p>
The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>		
			
			</div>
			<div class="col-12 col-sm-6 col-lg-4 px-5 text-left">
			<img src="<?=SITE_PATH?>images/working/6.svg">
			<h4>The Data works for you</h4><p>
Making the data works for you: visibility 
of your system health, monitoring, analytics,anomalies prediction, availability reports, security, incident investigation etc.</p>			
			
			</div>
		</div>
		<div class="row mobile-only-flex">
		
		
			<div class="col-12">


<div id="streams-slider" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#streams-slider" data-slide-to="0" class="active"></li>
		<li data-target="#streams-slider" data-slide-to="1"></li>
		<li data-target="#streams-slider" data-slide-to="2"></li>
		<li data-target="#streams-slider" data-slide-to="3"></li>
		<li data-target="#streams-slider" data-slide-to="4"></li>
		<li data-target="#streams-slider" data-slide-to="5"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="<?=SITE_PATH?>images/working/1.svg">
			<h4>Highly performant</h4><p>
Access to all saved data at any time, 
no matter how big the stored data is. Logrange is able to save millions of records per second.</p>			
		</div>
		<div class="carousel-item">
			<img src="<?=SITE_PATH?>images/working/2.svg">
			<h4>Scalable</h4><p>
By data - accepts thousands data sources. Logrange HA cluster allows to save more data and serve more client requests.</p>
		</div>
		<div class="carousel-item">
			<img src="<?=SITE_PATH?>images/working/3.svg">
			<h4>Open Source</h4><p>
Written entirely in Go, Logrange is available under the Apache 2.0 license for easy adoption.  Run it yourself, or use pre-build installations.</p>			
		</div>
		<div class="carousel-item">
			<img src="<?=SITE_PATH?>images/working/4.svg">
			<h4>Secure</h4><p>
The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>			
		</div>
		<div class="carousel-item">
			<img src="<?=SITE_PATH?>images/working/5.svg">
			<h4>Aggregate Data from Everywhere</h4><p>
The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>		
		</div>
		<div class="carousel-item">
			<img src="<?=SITE_PATH?>images/working/6.svg">
			<h4>The Data works for you</h4><p>
Making the data works for you: visibility 
of your system health, monitoring, analytics,anomalies prediction, availability reports, security, incident investigation etc.</p>			
		</div>
	</div>
  <a class="carousel-control-prev" href="#streams-slider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#streams-slider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>			
			
			
			
			</div>
		
		
		
		
		
		
		
		
		
		</div>
	</div>
	</div>
</div>
<div class="container-fluid how-it-works">
	<div class="container">
		<div class="row text-center mb-0 mb-sm-5 pb-0 pb-sm-5">
			<div class="col-12">
				<h2>How it works?<br>Give me an example!</h2>
				<div class="ellipsis non-mobile-only"><div></div><div></div><div></div></div>
				<div class="how-it-works-media">
					<div class="top-block">Basic Logrange installation contains<br>everything to work with logs</div>
					<div class="row justify-content-between non-mobile-only">
						<div class="w-25 text-center">
						<img src="<?=SITE_PATH?>images/howitworks/1.svg" class="slide w-75">
						<div class="slide-num">1</div>
						<p>The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>
						</div>
						<div class="w-25 text-center">
						<img src="<?=SITE_PATH?>images/howitworks/2.svg" class="slide w-75" style="margin-top: 160px">
						<div class="slide-num">2</div>
						<p>Logrange server persists the log data from the agents and serves the client requests. It supports LQL - <span class="color-blue font-weight-bold">Logrange Query Language</span></p>
						</div>
						<div class="w-25 text-center pt-3">
						<img src="<?=SITE_PATH?>images/howitworks/3.svg" class="slide w-100">
						<div class="slide-num">3</div>
						<p>Logrange clients allow to search the data or send it to 3rd party systems</p>
						</div>
					</div>
					<div class="ar-left non-mobile-only"><img src="<?=SITE_PATH?>images/howitworks/ar_left.png"></div>
					<div class="ar-right non-mobile-only"><img src="<?=SITE_PATH?>images/howitworks/ar_right.svg"></div>
					<div class="row mobile-only-flex">
						<div class="col-2">
						<div class="slide-num">1</div>
						</div>
						<div class="col-10">
						<p>The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>
						</div>
						<div class="col-2">
						<div class="slide-num">2</div>
						</div>
						<div class="col-10">
						<p>Logrange server persists the log data from the agents and serves the client requests. It supports LQL - <span class="color-blue font-weight-bold">Logrange Query Language</span></p>
						</div>
						<div class="col-2">
						<div class="slide-num">3</div>
						</div>
						<div class="col-10">
						<p>Logrange clients allow to search the data or send it to 3rd party systems</p>
						</div>
						<div class="col-12">
						<img src="<?=SITE_PATH?>images/howitworks/1.svg" class="slide w-50">
						</div>
						<div class="col-12">
						<img src="<?=SITE_PATH?>images/howitworks/arrow_bottom-1.png" class="arrow-bottom">
						</div>
						<div class="col-12">
						<img src="<?=SITE_PATH?>images/howitworks/2.svg" class="slide w-50">
						</div>
						<div class="col-12">
						<img src="<?=SITE_PATH?>images/howitworks/arrow_bottom-2.png" class="arrow-bottom">
						</div>
						<div class="col-12">
						<img src="<?=SITE_PATH?>images/howitworks/3.svg" class="slide w-50">
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>
<div class="container-fluid get-logrange" style="overflow:hidden" id="get-logrange"><!--get-logrange-->
	<div class="container text-center">
		<div class="row">
			<div class="col-12">
				<h2>Get Logrange!</h2>
			</div>
			<div class="col-1 d-none d-sm-flex"></div>
			<div class="col-12 col-sm-5">
			<p class="get-logrange-intro mb-4 text-center text-sm-left d-inline-block d-sm-block">Logrange master branch is under active development and it is not production ready yet.<br>
<br>It is 100% open-source, so you can</p>
                <a href="https://github.com/logrange/logrange#quick-start" class="btn btn-logrange btn-logrange-primary-alt d-inline-block float-sm-left"><div class="github-logo"></div>Try It Right Now</a>
			</div>
			<div class="col-12 col-sm-6">
				<div class="screen">
					<div class="tabs">
						<ul class="nav nav-tabs" role="tablist" id="screenTabs">
							<li class="nav-item">
								<a class="nav-link active" id="standalone-tab" data-toggle="tab" href="#standalone" role="tab" aria-controls="standalone" aria-selected="true">STANDALONE</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="kubernetes-tab" data-toggle="tab" href="#kubernetes" role="tab" aria-controls="kubernetes" aria-selected="true">KUBERNETES</a>
							</li>
						</ul>
					</div>
					<div class="tab-info">
                        <div class="tab-content" id="screenTabsContent">
                            <div class="tab-pane show active" id="standalone" role="tabpanel" aria-labelledby="standalone-tab">
                                # make and enter logrange install dir<br>
                                <b></b>mkdir /tmp/lrquick && cd /tmp/lrquick<br><br>

                                # download logrange install script<br>
                                <b></b>curl -sO http://get.logrange.io/install<br/>
                                <b></b>chmod +x ./install<br><br>

                                # install and run logrange aggregator<br>
                                <b></b>./install logrange -d ./bin<br>
                                <b></b>./bin/logrange start --base-dir=./data --daemon<br><br>

                                # install and run logrange collector<br>
                                <b></b>./install lr -d ./bin<br>
                                <b></b>./bin/lr collect --storage-dir=./collector --daemon<br><br>

                                # run logrange shell to make your first LQL query!<br>
                                <b></b>./bin/lr shell<br>
                            </div>
                            <div class="tab-pane" id="kubernetes" role="tabpanel" aria-labelledby="kubernetes-tab">
                                # add helm logrange helm repo and update<br>
                                <b></b>helm repo add logrange http://get.logrange.io/k8s/helm/<br>
                                <b></b>helm repo update<br><br>

                                # install logrange components<br>
                                <b></b>helm install logrange/lr-configs<br>
                                <b></b>helm install logrange/lr-aggregator<br>
                                <b></b>helm install logrange/lr-collector<br>
                                <b></b>helm install logrange/lr-forwarder<br><br>

                                # download and install logrange client<br>
                                <b></b>curl -s http://get.logrange.io/install | bash -s -- lr -d /usr/local/bin<br><br>

                                # run logrange shell to make your first LQL query!<br>
                                <b></b>lr shell --server-addr=lr-aggregator.kube-system.svc.cluster.local:9966<br>
                            </div>
                        </div>
					</div>
					<div class="tabs">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a class="nav-link" id="copy2clipboard" data-toggle="tab">Copy to clipboard</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--^get-logrange-->
<div class="container-fluid contact-us"><!--contact_us-->
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-12 col-sm-5 pr-5">
				<h3 class="text-center text-sm-left">Contact us</h3>
				<p>Should you reject to save your system logs due to storage cost or the logs size?</p>
				<p>Are you considering to have security alerts and notifications for your system?</p>
				<p>You have multiple monitoring tools for your system, but still think that having one place with all kinds of analytics is a good idea?</p>
				<p>Do you want to have something like anomalies prediction?</p>
				<p>Or may be you want to improve your system monitoring and analytics. Contact us and let us help you to resolve this problems.</p>

			</div>
			<div class="col-12 col-sm-5">
				<h4 id="formInfo" class="w-100 text-center"></h4>
				<form method="post" action="/sendform">
					<input type="text" class="form-control" placeholder="Your name" name="name" pattern="[a-zA-Z '-.]+">
					<input type="text" class="form-control" placeholder="Your email" name="email" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
					<textarea class="form-control mb-3" placeholder="Say hello..." name="message" minlength="10" maxlength="5000" required></textarea>
					<div class="button-container">
						<button class="btn btn-logrange btn-logrange-primary submit-button">Send message</button>
					</div>
				</form>
			</div>
			<div class="col-sm-1"></div>
		</div>
</div><!--^contact_us-->

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>
<script type="text/javascript">
$("form").validate({
	rules: {
		email: {
			required: true,
			email: true
			},
		message: {
			minlength: 10,
			maxlength: 5000
		}
	}
});
$("form").on("submit", function() {return false;});
$("form input").on("keyup", function() {
	$(".submit-button")
		.on("mouseup", function() {
			if ($("form").valid())
			$.post("", $("form").serialize(), function(data){
				var j = JSON.parse(data);
				if (j.status == "ok") {
					showInfo("Thank you very much for your feedback.<br>We very appreciate you for it!");
					$("form").addClass("smooth-hidden");
				} else {
					showInfo("<span class='color:red'>" + j.message + "</span>");
				}
				}).fail(function(){
					showInfo("<span class='color:red'>Oops. Could not send the form to the server. Could you try once again later? Sorry about this.</span>");
				});
			});
	$("form input").off("keyup");

});
</script>
<?
function checkFeedback() {
	if (!isset($_POST) || !count($_POST)) return;
	$errors = [];
	if (!isset($_POST["email"]))
		$errors [] = "Email is required.";
	if (!isset($_POST["message"]))
		$errors [] = "Your message is empty.";
	else
		if (strlen($_POST["message"]) < 10 || strlen($_POST["message"]) > 5000)
		{
			$errors [] = "Message size could be 10-5000 characters.";
		}
	if (count($errors))
	{
		echo json_encode(["status" => "error", "message" => implode("<br>", $errors)]);
	}
	else
	{
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."/feedbackResult.html", "<tr><td>".date("m/d/Y H:i:s")."</td><td>".htmlspecialchars($_POST["name"])."</td><td>".htmlspecialchars($_POST["email"])."</td><td>".htmlspecialchars($_POST["message"])."</td></tr>\n", FILE_APPEND);
		echo json_encode(["status" => "ok", "message" => ""]);
	}
	die();
}