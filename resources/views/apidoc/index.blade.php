<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
	<link href='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/css/typography.css')}}' media='screen' rel='stylesheet' type='text/css' />
	<link href='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/css/reset.css')}}' media='screen' rel='stylesheet' type='text/css' />
	<link href='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/css/screen.css')}}' media='screen' rel='stylesheet' type='text/css' />
	<link href='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/css/reset.css')}}' media='print' rel='stylesheet' type='text/css' />
	<link href='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/css/print.css')}}' media='print' rel='stylesheet' type='text/css' />

	<style type="text/css">
		#header .swagger-ui-wrap{
			/* margin-left:20px;
			margin-right:20px; */
		}

		#api_selector{
			/* margin-right:200px; */
		}

		.ext-hidden {
			display: none;
		}

		#condition {
			width: 410px;
		}

		#apiName {

		}

		#apiKey {
			width:170px;
		}

		#apiPosition {
			font-size: 0.9em;
			height: 1.8em;
			width: 180px;
		}

		#btn-api-auth {
			display: block;
			text-decoration: none;
			font-weight: bold;
			padding: 6px 8px;
			font-size: 0.9em;
			color: white;
			background-color: #547f00;
			border-radius: 4px;
		}

		ul.api-auth{
			display: none;
			position: absolute;
			top: 40px;
			overflow: hidden;
			background-color: #fff;
			overflow-y: auto;
			border: 1px solid #999;
			border-top: 0;
			box-shadow: 0 3px 5px #999;
			z-index: 9999;
			padding:10px 0;
		}

		ul.api-auth li {
			height: 30px;
			line-height: 30px;
			overflow: hidden;
			padding: 0 10px;
			cursor: pointer;
			width:100%;
		}

		.input-select{
			width: 200px;
			height: 25px;
			background: #fff url(../../swagger/images/input-select.jpg) no-repeat right center;
		}

		.input-select input {
			background-color: #fff;
			position:absolute;
			border: 0;
			outline: 0;
			background: none;
		}

		.input-select ul {
			width: 200px;
			display: none;
			position: absolute;
			top: 40px;
			overflow: hidden;
			background-color: #fff;
			overflow-y: auto;
			/* border: 1px solid #999; */
			border-top: 0;
			box-shadow: 0 3px 5px #999;
			z-index: 9999;
		}

		.input-select ul li {
			height: 30px;
			line-height: 30px;
			overflow: hidden;
			padding: 0 10px;
			cursor: pointer;
		}

		.input-select ul li.on {
			background-color: #e0e0e0;
		}

		#apiBtn {
			text-decoration: none;
			font-weight: bold;
			padding: 6px 8px;
			font-size: 0.9em;
			color: white;
			background-color: #547f00;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;
			-o-border-radius: 4px;
			-ms-border-radius: 4px;
			-khtml-border-radius: 4px;
			border-radius: 4px;
		}

		.dev-status a{
			text-transform: uppercase;
			text-decoration: none !important;
			color: white !important;
			background-color: #e67e22;
			display: inline-block;
			width: 50px;
			font-size: 0.7em;
			text-align: center;
			padding: 7px 4px 4px 4px;
			border-radius: 2px;
			text-decoration: none;
		}
	</style>

	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/jquery-1.8.0.min.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/jquery.slideto.min.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/jquery.wiggle.min.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/jquery.ba-bbq.min.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/handlebars-2.0.0.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/underscore-min.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/backbone-min.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/swagger-ui-ext.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/highlight.7.3.pack.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/marked.js')}}' type='text/javascript'></script>
	<script src='{{ admin_asset('vendor/dcat-admin-extensions/ycookies/api-tester/lib/swagger-oauth.js')}}' type='text/javascript'></script>

	<!-- Some basic translations -->
	<!-- <script src='lang/translator.js' type='text/javascript'></script> -->
	<!-- <script src='lang/ru.js' type='text/javascript'></script> -->
	<!-- <script src='lang/en.js' type='text/javascript'></script> -->

	<script type="text/javascript">
		$(function() {
			//初始化swaggerUI
			initSwaggerUi();

			//初始化接口授权
			initApiAuth();

			//初始化文档浏览
			initExplore();

			//国际化
			$("#language").change(function(){
				window.swaggerUi.setLocale($("#language").val());
				window.swaggerUi.load();
			});
		});

		//初始化swaggerUI
		function initSwaggerUi(){
			var url = getApiUrl();

			// Pre load translate...
			if (window.SwaggerTranslator) {
				window.SwaggerTranslator.translate();
			}
			window.swaggerUi = new SwaggerUi(
					{
						url : url,
						validatorUrl : null,
						dom_id : "swagger-ui-container",
						supportedSubmitMethods : [ 'get', 'post', 'put', 'delete','patch' ],
						//字符集设置
						//en:英文
						//zh_CN:中文(简体)
						locale : "zh_CN",
						onComplete : function(swaggerApi, swaggerUi) {
							if (typeof initOAuth == "function") {
								initOAuth({
									clientId : "your-client-id",
									clientSecret : "your-client-secret",
									realm : "your-realms",
									appName : "your-app-name",
									scopeSeparator : ","
								});
							}

							if (window.SwaggerTranslator) {
								window.SwaggerTranslator.translate();
							}

							$('pre code').each(function(i, e) {
								hljs.highlightBlock(e)
							});

							addApiKeyAuthorization();

							//初始化文档环境下拉框
							initEnv();
						},
						onFailure : function(data) {
							log("Unable to Load SwaggerUI");
						},
						docExpansion : "none",
						//模块排序
						apisSorter : "sortWeight",
						//模块内部方法排序
						operationsSorter : "sortWeight",
						//方法响应排序
						operationResponsesSorter : "sortWeight",
						showRequestHeaders : false
					});

			window.swaggerUi.load();
		}

		//初始化文档浏览
		function initExplore(){
			//浏览接口文档
			$("#explore").click(function(){
				/* var apiUrl = getApiUrl();
				var loadUrl = apiUrl;
				if(apiUrl.indexOf("?") != -1){
					loadUrl += "&condition=" + decodeURIComponent($("#condition").val());
				}
				else{
					loadUrl += "?condition=" + decodeURIComponent($("#condition").val());
				}

				$("#input_baseUrl").val(loadUrl); */

				if (window.SwaggerTranslator) {
					window.SwaggerTranslator.translate();
				}
			});

			//回车查询
			$("body").keydown(function() {
				if (event.keyCode == "13") {//keyCode=13是回车键
					$("#explore").click();
				}
			});
		}

		//获取文档url
		function getApiUrl(){
			var url = window.location.search.match(/url=([^&]+)/);
			if (url && url.length > 1) {
				url = decodeURIComponent(url[1]);
			}
			else {
				/* url = "http://petstore.swagger.io/v2/swagger.json"; */
				url = $("#docUrl").val();
			}

			return url;
		}

		//初始化接口授权
		function initApiAuth(){
			$('#apiKey').change(addApiKeyAuthorization);

			//接口访问令牌设置
			$(".api-auth").hide();

			$("#btn-api-auth").click(function(){
				$("ul.api-auth").show();
			});

			$("#apiBtn").click(function(){
				$("ul.api-auth").hide();
			});
		}

		function addApiKeyAuthorization() {
			var apiName = $("#apiName").val();
			if(!apiName || apiName.trim() == ''){
				apiName = "api_key";
			}

			var apiPosition = $("#apiPosition").val();
			if(!apiPosition || apiPosition.trim() == ''){
				apiPosition = "query";
			}

			var apiKey = $('#apiKey').val(); //encodeURIComponent();
			if (apiKey && apiKey.trim() != "") {
				var apiKeyAuth = new SwaggerClient.ApiKeyAuthorization(
						apiName, apiKey, apiPosition);
				window.swaggerUi.api.clientAuthorizations.add(apiName,
						apiKeyAuth);
				log("added key " + apiKey);
			}
		}

		function log() {
			if ('console' in window) {
				console.log.apply(console, arguments);
			}
		}

		//初始化环境
		function initEnv(){
			$('.input-select').click(function(e){
				$('.input-select').find('ul').hide();
				$(this).find('ul').show();
				e.stopPropagation();
			});

			$('.input-select li').hover(function(e){
				$(this).toggleClass('on');
				e.stopPropagation();
			});

			$('.input-select li').click(function(e){
				var apiBaseUrlJqObj = $(this).parents('.input-select').find('input');
				apiBaseUrlJqObj.val($(this).attr("data-value"));
				$('.input-select ul').hide();

				e.stopPropagation();
			});

			$(document).click(function(){
				$('.input-select ul').hide();
			});
		}
	</script>
</head>

<body class="swagger-section">
<input type="hidden" id="docUrl" value="<?php echo $_SERVER['REQUEST_SCHEME'];?>://<?php echo $_SERVER['SERVER_NAME'];?>/admin/ycookies/api-tester/proj/jsonBuild?docId=<?php echo $_GET['docId'];?>">
<div id='header'>
	<div class="swagger-ui-wrap" style="max-width:1000px;">
		<a id="logo" href="#">喜大文档</a>
		<form id='api_selector'>
			<div class='input'>
				<input placeholder="" id="input_baseUrl" name="baseUrl" type="hidden" value="http://learnku.test/api/jsonBuild?docId=<?php echo $_GET['docId'];?>">
			</div>
			<div class="input">
				<input placeholder="接口名称  /  请求url  /  标签" id="condition" name="condition" type="text">
			</div>
			<div class='input'>
				<a id="explore" href="javascript:void(0);">Explore</a>
			</div>
			<div class='input'>
				<!-- <a id="explore" href="#" data-sw-translate>Explore</a> -->
				<a id="btn-api-auth" href="javascript:void(0);">接口令牌设置</a>
				<ul class="input api-auth ext-hidden">
					<li>
						<input placeholder="接口令牌名称" id="apiName" name="apiName" type="text" value="Authorization" />
					</li>
					<li>
						<?php if($_SERVER['SERVER_NAME'] == 'service.dsxia.cn'){?>
						<input placeholder="接口令牌值" id="apiKey" name="apiKey" type="text" value="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjgzOTVhNzk4MDU5Nzg0NDlmMGU2MGZjNWJmOWM4Y2M2MTkwNGM5YjQ3OTRiYjFiZDdjZjMwYWJlMDFiMThiZTk5MTc1YTQ5YmU0YWFiNzQ5In0.eyJhdWQiOiIxIiwianRpIjoiODM5NWE3OTgwNTk3ODQ0OWYwZTYwZmM1YmY5YzhjYzYxOTA0YzliNDc5NGJiMWJkN2NmMzBhYmUwMWIxOGJlOTkxNzVhNDliZTRhYWI3NDkiLCJpYXQiOjE2NjA1MzYxMDAsIm5iZiI6MTY2MDUzNjEwMCwiZXhwIjoxODE4MjE2MTAwLCJzdWIiOiIxMyIsInNjb3BlcyI6W119.eWVLkbU_5TqdqHDGPSeIQvLVFiSVxSbQsbJQR8LnQQl2xNbeF_Pri4Tp_8185DieeFCX1iYJfUU8NqNbiQuknl3uI7fp9NTjps-qF2WUd6i3HYyFuG3esx74FIAcUqOZ8kdt_6zpOOdjohxy8FCXx1a60p0KkcYJdsPAIfsaplN0lEW_xDKj64UzuRvlVzKr0BMQFzg3IIt_l6e64-I4yf2Ge6Ykvhmgg8jivVXqr78UHkz2BEaQ5vXxbWyb4c61bDIrFrgt0O5SjeEPbEByIPEQ4vaawsd9FUg24pBsaT6ZWIzHxBxZA2g5cH83BvA4INDl-9o1n_7s_xsnGNz2ZZg8MqMkIF0Y8RE2KuaRLfqSz88faEKGmiSjnFRiwGb2x8VjF8I-lTChtACygWWEN9YbzAMSQC9DzehkwLj7V1jr2VYboFwfCbBNr2jqqg2bIRbb-_dh2Jsq3mOz-fFaRnnNzn4wUWUnZch2kEOSYznsmoAqYDAGP2F0Q3Lk-xpMIoRHkM0wCJ4z40lx_VeLDh_iqyqpucy7JyNBoaq45cl2kS1c3ynUY68u2uQ2pYo2gIKXWaI0QAlEcfSJjqK7z0npKlOyIyIZZrnNe0lUYUer-y3rh32z3Q2xOS8mU2xEelCG0Yi3G78uAzCtMBRUBoPz5f5EOOfPHW5OaTM9hAE" />
						<!-- eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI1ZGVmNzVkNjEzYjYxOTg1YzJmZjI4NjY0NmZjYzU5OThjZjUwYWIxODJhMDdiNjY1YjQ2NzMwNjcxNWZjZmQwY2YxNjFmOWJmZWFiNTI2In0.eyJhdWQiOiIxIiwianRpIjoiMjVkZWY3NWQ2MTNiNjE5ODVjMmZmMjg2NjQ2ZmNjNTk5OGNmNTBhYjE4MmEwN2I2NjViNDY3MzA2NzE1ZmNmZDBjZjE2MWY5YmZlYWI1MjYiLCJpYXQiOjE2NDA3NDczNjIsIm5iZiI6MTY0MDc0NzM2MiwiZXhwIjoxNzk4NDI3MzYyLCJzdWIiOiIxMyIsInNjb3BlcyI6W119.XQboEHWITu8T1dqT9v4ZZAZ-FSgUYR9e6B5FPIH78irpV0y311yOM1h-rE-h_THTQfD9XqVBwZvpGzobcUUy3tQgoTmqi230dCNoZEDL84v1K9wfF7LJ4mhAVuvC_UYLlYaEcXbOHwbSC0dEehRN7sSvOn7TC0BduqEeApjy2QnUNZp77pfkNHD4pvbKy15DXO2nN6PmLJNzW8IHSJ8rdgXMUqv67PR9nI7kx6KbSi3FJOX4SR6qwxid7wDrbYzwRywDqYjwwTxCwt3014xakcHbEt7D_qEnFAQFTa0zQtsgfJILRB4WqCUaPOfhD1F1nvFZcbGj8nUW5V-ZwguqvLYSrR87xafYaB06R4stxe-V4YpE4dNPNw_Z9kQnaBKJg-X8uEDabQRaFwDOYCb4ju9wgb76EPz7V4BX_QB0B24h3d-mIsIBbC1oScyh_RWnaCqGlL8IJcoeXykgSBNdA5gvW5MggiXLGZuJwuS5MWrgmMO5VsOK45pd1w9XEZnFDcuGBihcfu9BTPykBr4S5gbD2D4HkOBV5WkI44fkSBNqaaPF_0XU3jaZMDZkG4q-nv1rqJPZcj47ZIo0F1qfbNzKL8Akpcntwi2Bm5C5tyW6lEVkUOQwFHZeJ2dN_hgXkvq2iV5fuaUSDq635UvSmcEafJhJ0Ee0aOd6F-ZzDn8 -->
						<?php  }elseif($_SERVER['SERVER_NAME'] == 'crm.saishiyun.net'){?>
						<input placeholder="接口令牌值" id="apiKey" name="apiKey" type="text" value="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI1ZGVmNzVkNjEzYjYxOTg1YzJmZjI4NjY0NmZjYzU5OThjZjUwYWIxODJhMDdiNjY1YjQ2NzMwNjcxNWZjZmQwY2YxNjFmOWJmZWFiNTI2In0.eyJhdWQiOiIxIiwianRpIjoiMjVkZWY3NWQ2MTNiNjE5ODVjMmZmMjg2NjQ2ZmNjNTk5OGNmNTBhYjE4MmEwN2I2NjViNDY3MzA2NzE1ZmNmZDBjZjE2MWY5YmZlYWI1MjYiLCJpYXQiOjE2NDA3NDczNjIsIm5iZiI6MTY0MDc0NzM2MiwiZXhwIjoxNzk4NDI3MzYyLCJzdWIiOiIxMyIsInNjb3BlcyI6W119.XQboEHWITu8T1dqT9v4ZZAZ-FSgUYR9e6B5FPIH78irpV0y311yOM1h-rE-h_THTQfD9XqVBwZvpGzobcUUy3tQgoTmqi230dCNoZEDL84v1K9wfF7LJ4mhAVuvC_UYLlYaEcXbOHwbSC0dEehRN7sSvOn7TC0BduqEeApjy2QnUNZp77pfkNHD4pvbKy15DXO2nN6PmLJNzW8IHSJ8rdgXMUqv67PR9nI7kx6KbSi3FJOX4SR6qwxid7wDrbYzwRywDqYjwwTxCwt3014xakcHbEt7D_qEnFAQFTa0zQtsgfJILRB4WqCUaPOfhD1F1nvFZcbGj8nUW5V-ZwguqvLYSrR87xafYaB06R4stxe-V4YpE4dNPNw_Z9kQnaBKJg-X8uEDabQRaFwDOYCb4ju9wgb76EPz7V4BX_QB0B24h3d-mIsIBbC1oScyh_RWnaCqGlL8IJcoeXykgSBNdA5gvW5MggiXLGZuJwuS5MWrgmMO5VsOK45pd1w9XEZnFDcuGBihcfu9BTPykBr4S5gbD2D4HkOBV5WkI44fkSBNqaaPF_0XU3jaZMDZkG4q-nv1rqJPZcj47ZIo0F1qfbNzKL8Akpcntwi2Bm5C5tyW6lEVkUOQwFHZeJ2dN_hgXkvq2iV5fuaUSDq635UvSmcEafJhJ0Ee0aOd6F-ZzDn8" />
						<?php  }else{?>
						<input placeholder="接口令牌值" id="apiKey" name="apiKey" type="text" value="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE4ZDZhYjdhZWM4ZDEwMmFlZjA2NzBjYjUzNDYzYjM3MTdkMTg3ZTMwODY3ODRiMjRkNGU2M2YxOTdjMGYwNjBjNTZiODk2YWZjM2MzYTZmIn0.eyJhdWQiOiIxIiwianRpIjoiMThkNmFiN2FlYzhkMTAyYWVmMDY3MGNiNTM0NjNiMzcxN2QxODdlMzA4Njc4NGIyNGQ0ZTYzZjE5N2MwZjA2MGM1NmI4OTZhZmMzYzNhNmYiLCJpYXQiOjE2Mzk1NjA1MDcsIm5iZiI6MTYzOTU2MDUwNywiZXhwIjoxNjcxMDk2NTA3LCJzdWIiOiIxMyIsInNjb3BlcyI6W119.hyk3D_MaeuQcnp_3IfiwcKFOb73dClnb6jmG3d3rMD3yc26VXcHoa5ylC-Hmal2A29MCVJMl2Y04KMLT2ecqSjcaIzmSws-dsQ3BMMM3dV7n86BrU7YgTkgN6F6U_v0j1gk2BSzjDBCci5UOrWm0c9c4NeO2iNBTtKG8aKztjwKO131iazw5vaJgK0PoKgHSwxIreluh3wlNSzMtcs0lMLryICfHhNXhehzdxS9s0FvTERZTp8vil2Dx3zFjmwNt4rXZsvBPWPJ5zjTRKoMrOOsscsGc4ZE1VS5njBwDhJsbP8VqlhBU9e2UHMVz6ntK_L6z09bjEPUDmaOyW2vIzkFvOXyEAoatOBba_NV86wULfq2CugoFCwYMcP17GSp5QHjiuvXffNYMBUNjWt9nx2z6g_HJcmCvt2TKNj_geIlrM3pKkfRdvSUeUSIjuUeuSrh4a0ZsCpvPlAWcH1LaHLkbowkEqulhJd6Kai3EPtD71STsh1nAFYdbZXJ-f-gT6DU3qDkP2-WP3BhVsxqmGeNjAk8gyi7RmjSuoj0qo7Tp-88DhsxQB3KvAbizMPInJLDA99o-L5twxf0CduiKjKefeuJ8UIdVPdoVHjQFWgj9gXtqnaYCgqA4wD41HUymlrcxyCxSbRGXc_5xOTxmCMEFjnomjXUqYEDoifuSESk" />

						<?php }?>
					</li>
					<li>
						<select id="apiPosition">
							<option value="header">令牌位置-header</option>
							<option value="query">令牌位置-query</option>
						</select>
					</li>
					<li>
						<a id="apiBtn" href="javascript:void(0);">确定</a>
					</li>
				</ul>
			</div>
			<div class='input'>
				<select id="language" class="ext-hidden">
					<option value="en">English</option>
					<option value="zh_CN">中文(简体)</option>
				</select>
			</div>

			<div class='input input-select'>
				<input id="apiBaseUrl" type="text" placeholder="设置接口基路径" value="<?php echo $_SERVER['REQUEST_SCHEME'];?>://<?php echo $_SERVER['SERVER_NAME'];?>/">
				<ul id="apiEnvSelect"></ul>
			</div>
		</form>
	</div>
</div>

<div id="message-bar" class="swagger-ui-wrap" data-sw-translate>&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>

<script id="errorCodeTmpl" type="text/html">
	<li id="resource_cust_ext_error_code" class="resource">
		<div class="heading">
			<h2>
				<a href="#!/cust_ext_error_code" class="toggleEndpointList" data-id="cust_ext_error_code">全局返回码</a>
			</h2>
			<ul class="options">
				<li>
					<a href="#!/cust_ext_error_code" id="endpointListTogger_cust_ext_error_code" class="toggleEndpointList" data-id="cust_ext_error_code" data-sw-translate="">显示/隐藏</a>
				</li>
				<li>
					<a href="#" class="collapseResource" data-id="cust_ext_error_code" data-sw-translate=""> 收缩 </a></li>
				<li>
					<a href="#" class="expandResource" data-id="cust_ext_error_code" data-sw-translate=""> 展开 </a>
				</li>
			</ul>
		</div>
		<ul class="endpoints" id="cust_ext_error_code_endpoint_list" style="display: none;">
			<li class="endpoint">
				<ul class="operations">
					<li class="post operation" id="cust_ext_error_code_get_1">
						<div class="content" id="cust_ext_error_code_get_1_content" style="display: block;border-top:1px solid #c3d9ec;">
							<table class="fullwidth">
								<thead>
								<tr>
									<th data-sw-translate="">返回码</th>
									<th data-sw-translate="">返回信息</th>
									<th data-sw-translate="">说明</th>
								</tr>
								</thead>
								<tbody class="operation-status">
								<!-- <tr>
                                    <td width="15%" class="code">200</td>
                                    <td class="markdown"></td>
                                    <td width="70%"></td>
                                </tr> -->
								</tbody>
							</table>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</li>
</script>
</body>
</html>
