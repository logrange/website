<?define ("PAGE", "front-page");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>

<div class="front-page-intro-block">
<h1>Logrange</h1>
<h2>streaming database</h2>
<p>Logrange is highly performant streaming database for aggregating data like application logs, system metrics, audit logs etc. from thousands of sources.</p>
<div class="button-container">
	<a href="#get-logrange" class="btn btn-logrange btn-logrange-primary d-inline-block mr-3 float-left smooth-scroll">Get started</a>
	<a href="https://github.com/logrange/logrange" class="btn btn-logrange btn-logrange-outline d-inline-block float-left"><div class="github-logo"></div>View on github</a>
</div>
</div>


</div><?//end of intro-block-container?>
<div class="container"><?//and new container and raw?>
	<div class="row working-with-streams-container position-relative">
	<div class="working-with-streams text-center px-5">
		<h2>Designed for working with streams</h2>
		<div class="row mx-0">
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
	</div>
	</div>
</div>
<div class="container-fluid how-it-works">
	<div class="container">
		<div class="row text-center mb-5 pb-5">
			<div class="col-12">
				<h2>How it works?<br>Give me an example!</h2>
				<div class="ellipsis"><div></div><div></div><div></div></div>
				<div class="how-it-works-media">
					<div class="top-block">Basic Logrange installation contains<br>everything to work with logs</div>
					<div class="row justify-content-between">
						<div class="w-25 text-center">
						<img src="<?=SITE_PATH?>images/howitworks/1.svg" class="slide w-75">
						<div class="slide-num">1</div>
						<p>The data is secure during access, transit and storage. Get the full control over your data either it is in cloud, containerized or stored on premises.</p>
						</div>
						<div class="w-25 text-center">
						<img src="<?=SITE_PATH?>images/howitworks/2.png" class="slide w-75" style="margin-top: 160px">
						<div class="slide-num">2</div>
						<p>Logrange server persists the log data from the agents and serves the client requests. It supports LQL - <span class="color-blue font-weight-bold">Logrange Query Language</span></p>
						</div>
						<div class="w-25 text-center pt-3">
						<img src="<?=SITE_PATH?>images/howitworks/3.png" class="slide w-100">
						<div class="slide-num">3</div>
						<p>Logrange clients allow to search the data or send it to 3rd party systems</p>
						</div>
					</div>
					<div class="ar-left"><img src="<?=SITE_PATH?>images/howitworks/ar_left.png"></div>
					<div class="ar-right"><img src="<?=SITE_PATH?>images/howitworks/ar_right.svg"></div>
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
			<div class="col-1"></div>
			<div class="col-5">
			<p class="get-logrange-intro mb-5">Logrange is under active development and it is not production ready yet.<br>
It is 100% open-source, so you can</p>
				<button class="btn btn-logrange btn-logrange-primary-alt d-inline-block float-left"><div class="github-logo"></div>Try It Right Now</button>
			</div>
			<div class="col-6">
				<div class="screen">
					<div class="tabs">
						<ul class="nav nav-tabs" role="tablist" id="screenTabs">
							<li class="nav-item">
								<a class="nav-link" id="standalone-tab" href="#standalone" data-toggle="tab" href="#standalone" role="tab" aria-controls="standalone" aria-selected="true">STANDALONE</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" id="kubernetes-tab" href="#kubernetes" data-toggle="tab" href="#kubernetes" role="tab" aria-controls="kubernetes" aria-selected="true">KUBERNETES</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="docker-tab" href="#docker" data-toggle="tab" href="#docker" role="tab" aria-controls="docker" aria-selected="true">DOCKER</a>
							</li>
						</ul>
					</div>
					<div class="tab-info">
<div class="tab-content" id="screenTabsContent">
  <div class="tab-pane" id="standalone" role="tabpanel" aria-labelledby="standalone-tab">

<b></b>mkdir lrquick<br>
<b></b>cd lrquick<br>
<b></b># Step 2. Install logrange server and run it<br>
<b></b>curl -s http://get.logrange.io/install | bash -s logrange -d ./bin<br>
<b></b>./bin/logrange start --base-dir=./data --daemon<br>
<b></b># Step 3. Install logrange client and start collecting logs from the machine<br>
<b></b>curl -s http://get.logrange.io/install | bash -s lr -d ./bin<br>
<b></b>./bin/lr collect --storage-dir=./collector --daemon<br>
  
  </div>
  <div class="tab-pane show active" id="kubernetes" role="tabpanel" aria-labelledby="kubernetes-tab">

<b></b>mkdir lrquick<br>
<b></b>cd lrquick<br>
<b></b># Step 3. Install logrange client and start collecting logs from the machine<br>
<b></b>curl -s http://get.logrange.io/install | bash -s lr -d ./bin<br>
<b></b>./bin/lr collect --storage-dir=./collector --daemon<br>
  
  </div>
  <div class="tab-pane" id="docker" role="tabpanel" aria-labelledby="docker-tab">

<b></b>mkdir lrquick<br>
<b></b>cd lrquick<br>
<b></b># Step 2. Install logrange server and run it<br>
<b></b>curl -s http://get.logrange.io/install | bash -s logrange -d ./bin<br>
<b></b>./bin/logrange start --base-dir=./data --daemon<br>
  
  </div>
</div>					
					
					
					
					
					
					</div>
				</div>
			
			
			</div>
		</div>
	</div>
</div><!--^get-logrange-->
<div class="container-fluid contact-us"><!--contact_us-->
		<div class="row">
			<div class="col-1"></div>
			<div class="col-5 pr-5">
				<h3>Contact us</h3>
				<p>Should you reject to save your system logs due to storage cost or the logs size?</p>
				<p>Are you considering to have security alerts and notifications for your system?</p>
				<p>You have multiple monitoring tools for your system, but still think that having one place with all kinds of analytics is a good idea?</p>
				<p>Do you want to have something like anomalies prediction?</p>
				<p>Or may be you want to improve your system monitoring and analytics. Contact us and let us help you to resolve this problems.</p>

			</div>
			<div class="col-5">
				<form>
					<input type="text" class="form-control" placeholder="Your name">
					<input type="text" class="form-control" placeholder="Your email">
					<textarea class="form-control mb-3" placeholder="Say hello..."></textarea>
					<div class="button-container">
						<button class="btn btn-logrange btn-logrange-primary">Send message</button>
					</div>
				</form>
				
			
			</div>
			<div class="col-1"></div>

		
		
		
		</div>


</div><!--^contact_us-->

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>