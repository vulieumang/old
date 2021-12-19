
	// Clouds

	var container, audioElement;
	var camera, tweenTA, scene, renderer, sky, mesh, fog, objeto, geometry, material,
	i, h, color, colors = [], sprite, size, x, y, z;
	var camera, scene, renderer,birds, bird;

	var boid, boids;
	
	var particleSystem, particleGeometry;
	var particles = [];

	var position = 8000;
	var veloc=4;
	var camposy=0;
	var camtposy=20;
	var isstorm=phpstorm;
	var issnow=phpsnow;
	
	
	var tweenCY, tweenCTY, tweenTA;
	
	var mouseX = 0, mouseY = 0;
	var start_time = new Date().getTime();

	var windowHalfX = window.innerWidth / 2;
	var windowHalfY = window.innerHeight / 2;

	// int
	no3d=0;
	
	function themedesp() {
		$('#themes').animate({ height: 160 }, 300);
		
	}
	
	var globath=0;
	
	function themesel2(th) {
		window.location='../old.php.htm'+th;
	}
	
	function themesel(th) {
		
		$('.drop').remove();
		
		$('#themes').animate({ height: 0 }, 300);
		
		var col='black';
		if ((th=='night') || (th=='rainynight')) col='white';
		
		
		
		$('#maintheme').attr('class','theme theme_'+th);
		
		$('#body').attr('class','body_'+th);
		
		$('#about').attr('class','about_'+th);
		
		$('#logo').css('backgroundImage','url(/imgs/logoanim_'+th+'.png)');
		$('#botabout').css('backgroundImage','url(/imgs/BOT_about_'+th+'.png)');
		$('#botwork').css('backgroundImage','url(/imgs/BOT_work_'+th+'.png)');
		$('#botblog').css('backgroundImage','url(/imgs/BOT_blog_'+th+'.png)');
		
		$('#mute').css('backgroundImage','url(/imgs/social/'+col+'/mute.png)');
		$('#iconfb').attr('src','/imgs/social/'+col+'/icon_fb.png');
		$('#icontw').attr('src','/imgs/social/'+col+'/icon_tw.png');
		
		var imgw=$('#imgweather').attr('src');
		var imgwl=imgw.split('/');
		$('#imgweather').attr('src','/imgs/weather/'+col+'/'+imgwl[4]);
		
		$(".post").each(function (i) {
			var id=this.id;
			$('#'+id).attr('class','post post_'+th);
		});
		
		$(".superpost").each(function (i) {
			var id=this.id;
			$('#'+id).attr('class','superpost post_'+th+' linksund');
		});
		
		$(".thcirc").each(function (i) {
			var id=this.id;
			$(this).attr('src','/imgs/social/'+col+'/theme.png');
		});
			
		$(".post").each(function (i) {
			var id=this.id;
			$('#'+id).attr('class','post post_'+th);
		});
		$(".work").each(function (i) {
			var id=this.id;
			$('#'+id).attr('class','work work_'+th);
		});
		
		if (no3d!=1) {
			
			var f=eval('fog_'+th);
			//alert(f);
			
			if (issnow==1) {
			// NIEVE 
			var newcopo = THREE.ImageUtils.loadTexture("imgs/copo_"+th+".png");
			var newmaterialsnow = new THREE.ParticleBasicMaterial({
					size : 30,
					map : newcopo,
					//blending : THREE.AdditiveBlending,
					depthTest : false,
					transparent : true,
					//vertexColors : true, //allows 1 color per particle,
					//opacity : .7
			});
			particleSystem.materials[0]=newmaterialsnow;
			}
				
			var newtexture = THREE.ImageUtils.loadTexture( '/imgs/cloud_'+th+'.png' );				
		
			var newmaterial = new THREE.MeshShaderMaterial( {
				uniforms: {
					"map": { type: "t", value:2, texture: newtexture },
					"fogColor" : { type: "c", value: f.color },
					"fogNear" : { type: "f", value: f.near },
					"fogFar" : { type: "f", value: f.far },
				},
				vertexShader: document.getElementById( 'vs' ).textContent,
				fragmentShader: document.getElementById( 'fs' ).textContent,
				depthTest: false

			} );
		
			var newmaterialst = new THREE.MeshShaderMaterial( {
				uniforms: {
					"map": { type: "t", value:2, texture: texturestorm },
					"fogColor" : { type: "c", value: f.color },
					"fogNear" : { type: "f", value: f.near },
					"fogFar" : { type: "f", value: f.far },
				},
				vertexShader: document.getElementById( 'vs' ).textContent,
				fragmentShader: document.getElementById( 'fs' ).textContent,
				depthTest: false

			} );
		
			
		
			mesh.materials[0]=newmaterial;
			mesh2.materials[0]=newmaterial;
			stormesh.materials[0]=newmaterialst;
			stormesh2.materials[0]=newmaterialst;
		
			if (storm!=1) {
				stormesh.materials[ 0 ].opacity=0;
				stormesh2.materials[ 0 ].opacity=0;
			}

			for ( var i = 0; i < phpbirds; i ++ ) {
				
				if ((th=='night') || (th=='rainynight')) {
					birds[ i ].materials[ 0 ] = new THREE.MeshBasicMaterial( { color:0x222222, opacity:1} );
				} else {
					birds[ i ].materials[ 0 ] = new THREE.MeshBasicMaterial( { color:0xf4f4f4, opacity:1} );
				}
			}
		}
		
	}
	
	function mute() {
		
		
		var c=($('#mute').attr('class'));
		if (c=='muteon') {
			$('#mute').attr('class','muteoff');
			
			createCookie('soloaudio',1,31);
			
			audioElement.volume=0.3;
			
			if (isstorm==1) {
			audioElementst.volume=0.6;
			audiothun1.volume=0.3;
			audiothun2.volume=0.3;
			}	
			
		} else {
			$('#mute').attr('class','muteon');
			
			createCookie('soloaudio',0,31);
			
			audioElement.volume=0;
			
			if (isstorm==1) {
			audioElementst.volume=0;
			audiothun1.volume=0;
			audiothun2.volume=0;
			}
			
		}
		
	}
	
	function ancho() {
	    var myWidth = 0,
	    myHeight = 0;
	    if (typeof(window.innerWidth) == 'number') {
	        //Non-IE
	        myWidth = window.innerWidth;
	    } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
	        //IE 6+ in 'standards compliant mode'
	        myWidth = document.documentElement.clientWidth;
	    } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
	        //IE 4 compatible
	        myWidth = document.body.clientWidth;
	    }
	    return myWidth - 15;
	}

	function alto() {
	    var myWidth = 0,
	    myHeight = 0;
	    if (typeof(window.innerWidth) == 'number') {
	        //Non-IE
	        myHeight = window.innerHeight;
	    } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
	        //IE 6+ in 'standards compliant mode'
	        myHeight = document.documentElement.clientHeight;
	    } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
	        //IE 4 compatible
	        myHeight = document.body.clientHeight;
	    }
	    return myHeight - 2;
	}
	
	var totdrops=0;
	
	function drop() {
		
		var d=Math.round(Math.random() * 9)+1;
		if ((d<6) && (totdrops<100)) {
		var x=Math.round(Math.random() * ancho())-40;
		var y=Math.round(Math.random() * alto())-100;
		var newdrop='<div class="drop drop'+d+'" style="top:'+y+'px; left:'+x+'px; -webkit-transform:rotate('+(x*y)+'deg) ; -moz-transform:rotate('+(x*y)+'deg) ; transform:rotate('+(x*y)+'deg) ; "></div>';
		//alert(newdrop);
		$('#body').append(newdrop);
		totdrops++;
		}
	}
	
	
	
	function showblog() {
		
	
		
		$('#blogg').show();
		
		var i=0;
	
		
		$(".post").each(function (i) {
			var id=this.id;
			i++;
			setTimeout("$('#"+id+"').animate({ opacity: 1 }, 300);",i*100);
			
		});
		
		$('.html5').hide();
		$('.contact').hide();
		$('#hold').hide();
		
		
		
	}
	
	function hideblog() {
		
		$('#steps').hide();
		
		$('#share').hide();
		$('.html5').show();
		$('.contact').show();
		$('#hold').show();
		
		var i=0;
		
		$('.superpost').width(0);
		
		$(".post").each(function (i) {
			var id=this.id;
			i++;
			setTimeout("$('#"+id+"').animate({ opacity: 0 }, 300);",i*20);
			
		});
		
		setTimeout("$('#blogg').hide();",1000);
		
	}
	
	
	function showworks() {
		
		var i=0;
		$('#works').show();
		
		$(".work").each(function (i) {
			var id=this.id;
			i++;
			setTimeout("$('#"+id+"').animate({ width: 750 }, 300);",i*40);
			
		});
		
		var i=0;
		$("#works h2").each(function (i) {
			var id=this.id;
			i++;
			setTimeout("$('#"+id+"').animate({ opacity: 1 }, 400);",i*80);
			
		});
	}
	
	
	
	function hideworks() {
		var i=0;
		$(".work").width(0);
		
		var i=0;
		$("#works h2").css('opacity',0);
		
		setTimeout("$('#works').hide();",100);
		
	}
	
	var ready3d=0;
	



	
	function onDocumentMouseDown( event ) {

		var position = { x : veloc, y: 0 };
		var target = { x : 80, y: 0 };
		tweenTA = new TWEEN.Tween(position).to(target, 6000).easing( TWEEN.Easing.Quadratic.EaseIn );
		tweenTA.onUpdate(function(){
		   veloc = position.x;
		});
		tweenTA.start();
		//tweenTA.start();

	}
	
	function onDocumentMouseUp( event ) {
		var position = { x : veloc, y: 0 };
		var target = { x : 4, y: 0 };
		tweenTA.stop();
		tweenTA = new TWEEN.Tween(position).to(target, (veloc/20)*1000).easing( TWEEN.Easing.Quadratic.EaseIn );
		tweenTA.onUpdate(function(){
		   veloc = position.x;
		});
		tweenTA.start();
		
		

	}

	function onDocumentMouseMove( event ) {

		mouseX = ( event.clientX - windowHalfX ) * 0.2;
		//mouseY = ( event.clientY - windowHalfY ) * 0.15;

	}

	function onWindowResize( event ) {

		camera.aspect = window.innerWidth / window.innerHeight;
		camera.updateProjectionMatrix();

		renderer.setSize( window.innerWidth, window.innerHeight );

	}

	function animate() {

		requestAnimationFrame( animate );
		render();
		//stats.update();
		
		
			
		TWEEN.update();

	}
	
	
	function show() {

							if (no3d==0) ready3d=1;

							//$('body').animate({ backgroundColor: "#444444" }, 20000);

							$('#loadtext').html('');
							$('#loadbar2').css('width','100%');

							setTimeout("$('#div3d').animate({ opacity: 1 }, 1200);",100);
							setTimeout("$('#botabout').animate({ opacity: 1.0 }, 2000);",1500);
							setTimeout("$('#botwork').animate({ opacity: 1.0 }, 2000);",2500);
							setTimeout("$('#botblog').animate({ opacity: 1.0 }, 2000);",3500);
							setTimeout("$('#loading').animate({ opacity: 0 }, 1000);",100);

							var hash = window.location.hash.slice(1);

							if (postget!='') { 
							hash='blog';	
							post=postget;
							} 

							if (hash=='') {



							setTimeout("$('#logo').animate({ opacity: 1.0 }, 2000);",2000);
							setInterval("guino(0)",1600);
							
							$('#loading').hide();

							if (no3d==0) {
							var position = camera.position;
							var target = { x : 0, y: 40 };
							tweenCY = new TWEEN.Tween(camera.position).to(target, 6000).easing( TWEEN.Easing.Cubic.EaseOut );
							tweenCY.start();

							if (isstorm==1) {

								thun1();
								thun2();


							}
							}

							//$(document.body).css('cursor','move');

							}

							show2();




						}

	function show2() {

					var hash = window.location.hash.slice(1);


					if (hash!='') $('#loading').hide();

					hl=hash.split('-');
					hash=hl[0];

					var post='';
					if (hl.length>1) post=hl[1];

					if (postget!='') { 
					hash='blog';	
					post=postget;
					}


					if (hash=='about') {
						baja();
					}
					if (hash=='work') {
						medio();
					}
					if (hash=='blog') {
						subir(post);
					}



	}

	
	var home=1;
	
	function closepost(post) 
	{
		
		window.location='#blog';
		//$('.post').show();
		//$('#'+post).animate({width:0},100);
		
	}
	
	function shareChannel(url, title, desc)
	    {
	    //alert(url+' '+title+' '+desc);
	
		// $('#share').html('<div class="addthis_toolbox addthis_default_style " style="width:500px"><a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:width="115" style="width:120px" addthis:url="'+url+'" addthis:title="'+title+'"  addthis:description="'+desc+'"></a><a class="addthis_button_google_plusone" g:plusone:size="medium"  addthis:url="'+url+'" addthis:title="'+title+'"  addthis:description="'+desc+'"></a><a class="addthis_counter addthis_pill_style"  addthis:url="'+url+'" addthis:title="'+title+'"  addthis:description="'+desc+'"></a>');
			
			
		// addthis.toolbox("#share");
		
	    }
	
	var post2;
	
	function subir(post) {
		post2=post;
		//alert(post);
		
		
			
		$('#blogg').show();
			
		if (post!='') {
			
			$('#steps').hide();
			$('.post').hide();
			setTimeout("$('#share').show();",1800);
			
			setTimeout("shareChannel('http://www.solointeractivestudio.com/post/"+post2+"', $('#"+post2+"tit').html(), $('#"+post2+"desc').html());",600);
			$('#'+post).animate({width:990},300);
			
			
		} else {
			$('.post').show();
			$('#steps').show();
			$('#share').hide();
			$('.superpost').width(0);
		
		}
		
		hideworks();
		
		setTimeout("showblog();",100);
		
		//location.href = '#blog';
		//mesh.materials[0]=material;
		//mesh2.materials[0]=material;
		$('#botblog').attr('class','bot botblog_sel');
		$('#botabout').attr('class','bot botabout');
		$('#botwork').attr('class','bot botwork');
		
		$('#about').animate({ height: 0 }, 400);
		$('#nubecitaimg').fadeOut();
		$('#soloanim').fadeOut();
		mnube=0;
		
		if (home==1) {
			$('#logo').animate({ marginTop: -50, opacity:0 }, 400);
			$('#botonera').animate({ marginTop: 176, opacity:0 }, 400);
			setTimeout("$('#botonera').css('top','-60px'); $('#botonera').css('margin-top','0px');",600);
			setTimeout("$('#botonera').animate({ top: 0, opacity:1 }, 400);",700);
		}
		
		home=0;
		
		if (ready3d==1) {
			
		var target = { x : 0, y: 75 };
		tweenCY = new TWEEN.Tween(camera.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCY.start();
		
		var target = { x : 0, y: 345 };
		tweenCTY = new TWEEN.Tween(camera.target.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCTY.start();
		
		}
		
		
		
		
	}
	
	function medio() {
		
		hideblog();
		//location.href = '#work';
		
		$('#botwork').attr('class','bot botwork_sel');
		$('#botabout').attr('class','bot botabout');
		$('#botblog').attr('class','bot botblog');
		
		
		$('#about').animate({ height: 0 }, 300);
		$('#nubecitaimg').fadeOut();
		$('#soloanim').fadeOut();
		mnube=0;
		
		if (home==1) {
			$('#logo').animate({ marginTop: -50, opacity:0 }, 400);
			$('#botonera').animate({ marginTop: 176, opacity:0 }, 400);
			setTimeout("$('#botonera').css('top','-60px'); $('#botonera').css('margin-top','0px');",500);
			setTimeout("$('#botonera').animate({ top: 0, opacity:1 }, 400);",600);
		}
		setTimeout("showworks();",100);
		
		home=0;
		
		if (ready3d==1) {
				
		var target = { x : 0, y: -90 };
		tweenCY = new TWEEN.Tween(camera.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCY.start();
		
		var target = { x : 0, y: 20 };
		tweenCTY = new TWEEN.Tween(camera.target.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCTY.start();
		
		}
		
		
	}
	
	//about
	var ap='home';
	
	var about=0;
	
	function blink() {
		
		if (mnube==1) {
		r=Math.random()*100;
		//alert(r);
		if (r>50) {
			
			$('#soloanim').attr('class','eye2');
			setTimeout("$('#soloanim').attr('class','eye1');",200);
			
		}
		
		r=Math.floor(Math.random()*2000)+100;
		setTimeout("blink()",r);
		}
		
	}
	
	function movenube() {
		
		
		
		
		//alert($('#nubecita').position().top);
		if ($('#nubecita').position().top>80) {
			$('#nubecita').animate({ top: 80}, 1800, function() {
			    if (mnube==1) { movenube(); }
			  });
		} else {
			$('#nubecita').animate({ top: 100}, 2000, function() {
			    if (mnube==1) { movenube(); }
			 });
		}
		
		
	}
	
	var mnube=0;
	
	function baja() {
		
			
		hideworks();
		hideblog();
		//location.href = '#about';
		
		//clearInterval(tnube);
		mnube=1;
		movenube();
		blink();
		//tnube=setInterval('movenube()',2500);
		$('#nubecita').show();
		$('#nubecitaimg').fadeIn();
		$('#soloanim').fadeIn();
		
		ap='about';
		$('#botabout').attr('class','bot botabout_sel');
		$('#botwork').attr('class','bot botwork');
		$('#botblog').attr('class','bot botblog');
		
		//$('#logo').animate({ marginTop: -224, opacity:1 }, 500);
		
		if (home==1) {
			$('#logo').animate({ marginTop: -50, opacity:0 }, 400);
			$('#botonera').animate({ marginTop: 176, opacity:0 }, 400);
			setTimeout("$('#botonera').css('top','-60px'); $('#botonera').css('margin-top','0px');",500);
			setTimeout("$('#botonera').animate({ top: 0, opacity:1 }, 400);",600);
			setTimeout("$('#about').animate({ height: 400 }, 400);",600);
		} else {
			
			setTimeout("$('#about').animate({ height: 400 }, 400);",900);
			
		}
		
		home=0;
		
		if (ready3d==1) {
				
		var target = { x : 0, y: 40 };
		tweenCY = new TWEEN.Tween(camera.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCY.start();
		
		var target = { x : 0, y: 20 };
		tweenCTY = new TWEEN.Tween(camera.target.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCTY.start();
			
		}
		
		
	}
	
	function bajahome() {
		hideworks();
		hideblog();
		location.href = '';
		
		ap='home';
		$('#about').animate({ height: 0 }, 400);
		$('#botabout').attr('class','bot botabout');
		$('#botwork').attr('class','bot botwork');
		$('#botblog').attr('class','bot botblog');
		
		//$('#logo').animate({ marginTop: -224, opacity:1 }, 500);
		
		
		$('#logo').animate({ marginTop: -174, opacity:1 }, 400);
		//$('#botonera').animate({ top: '50%', opacity:1 }, 600);
			
		
		home=1;
		
		var target = { x : 0, y: 40 };
		tweenCY = new TWEEN.Tween(camera.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCY.start();
		
		var target = { x : 0, y: 20 };
		tweenCTY = new TWEEN.Tween(camera.target.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCTY.start();
			
	
		
		
	}
	
	function bajahome2() {
		hideworks();
		hideblog();
		//location.href = '';
		
		ap='home';
		$('#about').animate({ height: 0 }, 400);
		$('#botabout').attr('class','bot botabout');
		$('#botwork').attr('class','bot botwork');
		$('#botblog').attr('class','bot botblog');
		
		//$('#logo').animate({ marginTop: -224, opacity:1 }, 500);
		$('#nubecita').hide();
		
		$('#logo').animate({ marginTop: -174, opacity:1 }, 400);
		$('#botonera').animate({ marginTop: -174, top: '50%', opacity:1 }, 600);
			
		
		home=1;
		
		var target = { x : 0, y: 40 };
		tweenCY = new TWEEN.Tween(camera.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCY.start();
		
		var target = { x : 0, y: 20 };
		tweenCTY = new TWEEN.Tween(camera.target.position).to(target, 2800).easing( TWEEN.Easing.Quartic.EaseInOut );
		tweenCTY.start();
			
	
		
		
	}
	
	var seno=new Array(0.5,0.1,0.9);
	
	function render() {
		seno[0]+=0.22;
		seno[1]+=0.25;
		seno[2]+=0.3;
		//nieve
		//loop thru each particle
		if (issnow==1) {
			for( i = 0; i < totcopos; i++) {
				particles[i].update();
			}

			particleGeometry.__dirtyVertices = true;
			//particleGeometry.__dirtyColors = true;

			//TODO - only do on change
			materialsnow.size = 20;
		}
			
	    //pajaros
		for ( var i = 0, il = birds.length; i < il; i++ ) {

			var bo = boids[ i ];
			bo.run( boids );

			var bi = birds[ i ];
			
			//op=bird.materials[ 0 ].opacity;
			//alert(op);
			//op=0.0;
			
			
			//color.r = color.g = color.b = ( 500 - bird.position.z ) / 1000;
			//color.updateHex();
			bi.position.z = bi.position.z + veloc*0.9;
			bo.position.y=bo.origy+Math.sin(seno[i%3])*2;
			bi.rotation.y = Math.atan2( - bo.velocity.z, bo.velocity.x );
			bi.rotation.z = Math.asin( bo.velocity.y / bo.velocity.length() );
			//bi.phase = ( bird.phase + ( Math.max( 0, bird.rotation.z ) + 0.1 )  ) % 62.83;
			bi.geometry.vertices[ 5 ].position.y = bi.geometry.vertices[ 4 ].position.y = Math.sin(seno[i%3])*4;
			bi.geometry.__dirtyVertices = true;

		}
		
		//audioElement.volume=veloc/10;
		
		position ++;

		camera.position.x += ( mouseX - camera.target.position.x ) * 0.01;
		camera.target.position.x = camera.position.x;
		
		
		//camera.position.y += (- mouseY) * 0.01;
		
		//camera.position.y = 35;
		//camera.target.position.y = 250;
		//camera.position.y = camposy;
		//camera.target.position.y = camtposy;
		
		
		
		//plane.position.x += ( mouseX - camera.target.position.x ) * 0.01;
		//plane.position.y += ( - mouseY - camera.target.position.y ) * 0.01;
		mesh.position.z = mesh.position.z + veloc;
		mesh2.position.z = mesh2.position.z + veloc;
		
		if (mesh.position.z > 8100) { mesh.position.z=0; stormesh.position.x=(Math.random()*2000)-1200; }
		if (mesh2.position.z > 8100) { mesh2.position.z=0; stormesh2.position.x=(Math.random()*2000)-1200; }
		
		stormesh.position.z = mesh.position.z -100;
		stormesh2.position.z = mesh2.position.z -100;
		
		//objeto.rotation.y += 0.01;

		renderer.render( scene, camera );
	}
	
	function trueno() {
		
		var posx=Math.round(Math.random()*18);
		//alert(posx);
		if (posx==1) setTimeout("audiothun1.play();",1000);
		if (posx==2) setTimeout("audiothun2.play();",1000);
	
	}
	
	function thun1() {
		if ((stormesh.position.z<7800) && (stormesh.position.z>5500)) {
		//alert(stormesh.position.z);
			var posx=(Math.random()*2000)-1200;
			//$('#logo').html(stormesh.position.z);
			stormesh.position.x=posx;
			trueno();
			stormesh.materials[ 0 ].opacity=1;
			setTimeout("stormesh.materials[ 0 ].opacity=0;",400);
		}
		var inte=Math.random()*3000;
		setTimeout("thun1();",inte);
	}
	
	function thun2() {
		if ((stormesh2.position.z<7600) && (stormesh2.position.z>5500)) {
		//alert(stormesh.position.z);
			var posx=(Math.random()*2000)-1200;
			stormesh2.position.x=posx;
			trueno();
			stormesh2.materials[ 0 ].opacity=1;
			setTimeout("stormesh2.materials[ 0 ].opacity=0;",400);
		}
		var inte=Math.random()*2600;
		setTimeout("thun2();",inte);
	}
	
	function closeno3d() {
		
		createCookie('solono3d',0,3);
		$('.detmes').fadeOut();
		
	}
	
	function openno3d() {
		
		document.body.appendChild(Detector.getWebGLErrorMessage()); 
		
	}
	
	function step(num) {
		
		$('#blogwrap').animate({left:-num*990},400);
		$('.step').attr('class','step stepnosel');
		$('#step'+num).attr('class','step stepsel');
					
	}
	////////////////////

	/**
	 * Particle Class handles movement of particles
	 */
	
	var boxW=1000;
	var boxH=1000;
	var boxD = 1000;
	var windSpeed=0.8+(Math.random() * 2) ;
	var particleLifeSpan=1000;
	var noiseScale = 114;
	var windDir = 0;
	var gravity=1;
	var colorize=1;
	var perlin;
	var totcopos=880;
	perlin = new ImprovedNoise();
	
	var Particle = function(id) {

		this.lifeSpan = 200;
		this.id = id;
		this.posn = new THREE.Vector3();
		this.screenPosn = new THREE.Vector3();
		particleGeometry.vertices.push(new THREE.Vertex(this.screenPosn));
		this.color = new THREE.Color();
		particleGeometry.colors.push(this.color);

		this.init = function() {

			//set random posn
			this.screenPosn.set(getRand(-boxW / 2, boxW / 2), getRand(-boxH / 2, boxH / 2), getRand(-boxD / 2, boxD / 2));

			this.posn.x = this.screenPosn.x + boxW / 2;
			this.posn.y = this.screenPosn.y + boxH / 2;

			//get color from Y posn
			//var col = map(this.screenPosn.y, -boxH / 2, boxH / 2, 0, 1);
			//var col = new THREE.Color( 0x000000 );
			//this.color.setHSV(col, colorize ? 1 : 0, 1);
			//this.color.setRGB(0,0,0);
			this.speed = getRand(windSpeed / 3, windSpeed);
			this.age = 0;
			this.lifespan = Math.random() * particleLifeSpan;
		}
		this.update = function() {

			this.id += 0.01;
			this.direction = perlin.noise(this.id, this.posn.x / noiseScale, this.posn.y / noiseScale);
			this.direction += windDir;

			this.posn.x += Math.cos(this.direction) * this.speed;
			this.posn.y += Math.sin(this.direction) * this.speed;
			//gravity
			this.posn.y -= gravity;

			if(this.posn.x < 0 || this.posn.y < 0) {
				this.init();
			}

			this.age++;
			if(this.age >= this.lifespan) {
				this.init();
			}

			this.screenPosn.x = this.posn.x - boxW / 2;
			this.screenPosn.y = this.posn.y - boxH / 2;

		}

		this.init();
	}
	////////////////////
	//UTILS
	////////////////////

	function getRand(minVal, maxVal, round) {
		var r = minVal + (Math.random() * (maxVal - minVal));
		if(round) {
			r = Math.round(r);
		}
		return r;

	}

	function map(value, istart, istop, ostart, ostop) {
		return ostart + (ostop - ostart) * ((value - istart) / (istop - istart));
	}
	
	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name,"",-1);
	}
	
	
					$(document).ready(function() {

						if ( ! Detector.webgl ) { no3d=1; 



							var no3dc=readCookie('solono3d');
							if (no3dc==null) {
								no3dc=1;
								createCookie('solono3d',1,3);
							}

							if (no3dc==1) {
								document.body.appendChild(Detector.getWebGLErrorMessage()); 

							} 

							$('#alert').show();


						}



					    jQuery.easing.def = 'easeInOutCubic';

						if (((phpmoment=='rainy') || (phpmoment=='rainynight')) && (phpstorm==0)) {
						setInterval("drop()",8000);
						}
						if ((phpstorm==1)) {
						setInterval("drop()",800);
						}

						if (noaudio==0) { 
						audioElement = document.createElement('audio');
						if (phpmoz>0) { 
						audioElement.setAttribute('src', 'audio/audio.ogg');
						} else { 
						audioElement.setAttribute('src', '../audio/audio.mp3');	
						} 
						audioElement.play();
						audioElement.preload="auto";
						audioElement.loop="true";
						audioElement.volume=0.3;


						if (phpstorm==1) { 
						audioElementst = document.createElement('audio');
						if (phpmoz>0) { 
						audioElementst.setAttribute('src', '../audio/storm.ogg');
						} else {
						audioElementst.setAttribute('src', '../audio/storm.mp3');	
						}
						audioElementst.play();
						audioElementst.preload="auto";
						audioElementst.loop="true";
						audioElementst.volume=0.6;


						audiothun1 = document.createElement('audio');
						if (phpmoz>0) { 
						audiothun1.setAttribute('src', '../audio/thun1.ogg'/*tpa=http://www.solointeractivestudio.com/audio/thun1.ogg*/);
						} else {
						audiothun1.setAttribute('src', '../audio/thun1.mp3'/*tpa=http://www.solointeractivestudio.com/audio/thun1.mp3*/);	
						}
						//audiothun1.play();
						audiothun1.preload="auto";
						audiothun1.loop="false";
						audiothun1.volume=0.3;

						audiothun2 = document.createElement('audio');
						if (phpmoz>0) { 
						audiothun2.setAttribute('src', '../audio/thun2.ogg'/*tpa=http://www.solointeractivestudio.com/audio/thun2.ogg*/);
						} else {
						audiothun2.setAttribute('src', '../audio/thun2.mp3'/*tpa=http://www.solointeractivestudio.com/audio/thun2.mp3*/);	
						} 
						//audiothun1.play();
						audiothun2.preload="auto";
						audiothun2.loop="false";
						audiothun2.volume=0.4;
						}

						} 

						//cokies
						var sound=readCookie('soloaudio');
						if (sound==null) {
							sound=1;
							createCookie('soloaudio',1,31);
						}

						//alert(sound);

						if (sound==0) {
							mute();
						}

						$('#logo').mouseup(function(e) {
						
							guino(1);
						});
						
						$('.post').mouseenter(function(e) {
							$('#'+this.id+'foto').animate({height:50},200);
						});
						
						$('.post').mouseleave(function(e) {
							$('#'+this.id+'foto').animate({height:5},100);

						});

						setTimeout("$('#loadtext').html('loading textures ...'); $('#loadbar2').css('width','20%');",600);

						$(window).bind('hashchange', function () { //detect hash change
						        var hash = window.location.hash.slice(1); //hash to string (= "myanchor")

								hl=hash.split('-');
								hash=hl[0];
								var post='';
								if (hl.length>1) post=hl[1];

						        if (hash=='') {
									bajahome();
								}
								
								if (hash=='home') {
								
									bajahome2();
								}

								if (hash=='about') {

									baja();

								}
								if (hash=='work') {

									medio();

								}
								if (hash=='blog') {

									subir(post);

								}
						});





						if (no3d==0) {
							show2();
							setTimeout("init();",1000);
							setTimeout("animate();",1000);

						} else {
							show();

						}
						
						

					});
					
					function guino(f) {

						var d=Math.round(Math.random() * 20);
						if ((d<7) || (f==1)) {
							//alert(2);
							setTimeout("$('#logo').attr('class','logofr2');",0);
							setTimeout("$('#logo').attr('class','logofr3');",80);
							setTimeout("$('#logo').attr('class','logofr1');",120);
							
							var d=Math.round(Math.random() * 9);
							if ((d<4) && (f==0)) {

								setTimeout("guino(1);",220);

							}
							
						}
						
						
					}

					function init() {



						container = document.getElementById('div3d');
						//document.body.appendChild( container );
						container.style.position = 'fixed';
						container.style.opacity = '0';
						container.style.zIndex = 2;

						camera = new THREE.Camera( 30, window.innerWidth / window.innerHeight, 1, 6000 );
						camera.position.z = 6000;

						scene = new THREE.Scene();

						geometry = new THREE.Geometry();


						//texture.magFilter = THREE.LinearMipMapLinearFilter;
						//texture.minFilter = THREE.LinearMipMapLinearFilter;

						// LIGHTS

						//var ambient = new THREE.AmbientLight( 0x000000 );
						//scene.addLight( ambient );



						material = new THREE.MeshShaderMaterial( {

							uniforms: phpfog,
							vertexShader: document.getElementById( 'vs' ).textContent,
							fragmentShader: document.getElementById( 'fs' ).textContent,
							depthTest: false

						} );

						materialstorm = new THREE.MeshShaderMaterial( {

							uniforms: phpfogs,
							vertexShader: document.getElementById( 'vs' ).textContent,
							fragmentShader: document.getElementById( 'fs' ).textContent,
							depthTest: false

						} );

						// NIEVE 
						var copo = THREE.ImageUtils.loadTexture("imgs/copo_"+phpmoment+".png");
						materialsnow = new THREE.ParticleBasicMaterial({
								size : 30,
								map : copo,
								//blending : THREE.AdditiveBlending,
								depthTest : false,
								transparent : true,
								//vertexColors : true, //allows 1 color per particle,
								//opacity : .7
							});


						plane = new THREE.Mesh( new THREE.Plane( 64, 64 ) );

						for ( i = 0; i < 5000; i=i+2 ) {

							plane.position.x = Math.random() * 1200 - 500;
							mas=Math.abs(plane.position.x)/40;
							plane.position.y = (- Math.random() * Math.random() * 200 - 15)+(mas*mas);
							plane.position.z = i;
							plane.rotation.z = Math.random() * Math.PI;
							plane.scale.x = plane.scale.y = Math.random() * Math.random() * 3.2 + 0.4;
							GeometryUtils.merge( geometry, plane );

						}

						storm = new THREE.Geometry();
						storm2 = new THREE.Geometry();

						plane = new THREE.Mesh( new THREE.Plane( 64, 64 ) );
						posx=Math.random() * 300;
						for ( i = 0; i < 100; i=i+2 ) {
							plane.position.x = (Math.random() * 300 - 150)+posx;
							mas=Math.abs(plane.position.x)/40;
							plane.position.y = (- Math.random() * Math.random() * 200 - 15)+10;
							plane.position.z = i;
							plane.rotation.z = Math.random() * Math.PI;
							plane.scale.x = plane.scale.y = Math.random() * Math.random() * 2.8 + 0.5;
							GeometryUtils.merge( storm, plane );
						}

						//plane = new THREE.Mesh( new THREE.Plane( 64, 64 ) );
						posx=Math.random() * 100;
						for ( i = 0; i < 100; i=i+2 ) {
							plane.position.x = (Math.random() * 300 - 150)+posx;
							mas=Math.abs(plane.position.x)/40;
							plane.position.y = (- Math.random() * Math.random() * 200 - 15);
							plane.position.z = i;
							plane.rotation.z = Math.random() * Math.PI;
							plane.scale.x = plane.scale.y = Math.random() * Math.random() * 2.8 + 0.5;
							GeometryUtils.merge( storm2, plane );
						}

						//logomesh = new THREE.Mesh( logo, material2 );
						//scene.addObject( logomesh );
						//logomesh.position.z=7650;
						//logomesh.position.y=-30;


						mesh = new THREE.Mesh( geometry, material );
						scene.addObject( mesh );
						mesh.position.z=5000;
						mesh.position.y=-0;

						mesh2 = new THREE.Mesh( geometry, material );
						scene.addObject( mesh2 );
						mesh2.position.z=1000;
						mesh2.position.y=-0;

						if (isstorm==1) {
							stormesh = new THREE.Mesh( storm, materialstorm );
							scene.addObject( stormesh );
			//				stormesh.position.z=4400;
							stormesh.position.y=-0;

							stormesh2 = new THREE.Mesh( storm2, materialstorm );
							scene.addObject( stormesh2 );
			//				stormesh2.position.z=4400;
							stormesh2.position.y=-0;
						} else {
							stormesh = new THREE.Mesh( storm, material );
							scene.addObject( stormesh );
			//				stormesh.position.z=4400;
							stormesh.position.y=-0;

							stormesh2 = new THREE.Mesh( storm2, material );
							scene.addObject( stormesh2 );
			//				stormesh2.position.z=4400;
							stormesh2.position.y=-0;


						}




						/*var loader = new THREE.BinaryLoader();
						loader.load( { model: "obj/lucy/Lucy100k_bin.js", callback: function( geom ) { 
							objeto = new THREE.Mesh( geom, new THREE.MeshPhongMaterial( { ambient: 0x030303, color: 0x030303, specular: 0x990000, shininess: 30 } ) );
							objeto.rotation.y = 5;
							objeto.scale.x = objeto.scale.y = objeto.scale.z = 1.4;
							objeto.position.z=6500;
							objeto.position.x=0;
							objeto.position.y=0;
							scene.addObject( objeto );
							 }

						 } );
						*/

						//pajaros

						birds = [];
						boids = [];

						for ( var i = 0; i < phpbirds; i ++ ) {

							boid = boids[ i ] = new Boid();
							boid.position.x = 200 + Math.random() * 800  ;
							//boid.position.y = 600 + Math.random() * 500 - 200;
							boid.origy=Math.random() * 100;
							boid.position.z = 7000;
							boid.velocity.x = Math.random() * 12 - 2;
							boid.velocity.y = Math.random() * 12 - 2;
							boid.velocity.z = Math.random() * 12 - 2;
							boid.setAvoidWalls( false );
							boid.setWorldSize( 10000, 500, 400 );

							
							if ((phpmoment=='night') || (phpmoment=='rainynight')) {
								bird = birds[ i ] = new THREE.Mesh( new Bird(), new THREE.MeshBasicMaterial( { color:0x000000, opacity:1} ) );
							} else {
								bird = birds[ i ] = new THREE.Mesh( new Bird(), new THREE.MeshBasicMaterial( { color:0xffffff, opacity:1} ) );
							}
							bird.dynamic = true;
							bird.phase = Math.floor( Math.random() * 62.83 );
							bird.position = boids[ i ].position;
							bird.doubleSided = true;
							bird.scale.x = bird.scale.y = bird.scale.z = 2 +Math.random()*1;
							scene.addObject( bird );

						}

							camera.position.y = -40;
							camera.position.z =  + 8100;
							camera.target.position.z = camera.position.z - 1000;

						if (issnow==1) {
						if(particleSystem)
								scene.removeObject(particleSystem);

							particleGeometry = new THREE.Geometry();


							//init particle system
							particleSystem = new THREE.ParticleSystem(particleGeometry, materialsnow);
							particleSystem.sortParticles = false;
							scene.addObject(particleSystem);

							particleSystem.position.z = 7100;

							for( i = 0; i < totcopos; i++) {
								var p = new Particle(i / totcopos);
								particles.push(p);
						}
						}

						renderer = new THREE.WebGLRenderer( { antialias: false } );
						renderer.setSize( window.innerWidth, window.innerHeight );
						container.appendChild( renderer.domElement );

						document.addEventListener( 'mousemove', onDocumentMouseMove, false );
						document.addEventListener( 'mousedown', onDocumentMouseDown, false );
						document.addEventListener( 'mouseup', onDocumentMouseUp, false );
						window.addEventListener( 'resize', onWindowResize, false );

						$('#loadtext').html('creating 3d sky ...');
						$('#loadbar2').css('width','60%');

						setTimeout('show()',3000);


					}

