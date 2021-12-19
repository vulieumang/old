/**
 * @author alteredq / http://alteredqualia.com/
 * @author mr.doob / http://mrdoob.com/
 */

Detector = {

	canvas : !! window.CanvasRenderingContext2D,
	webgl : ( function () { try { return !! window.WebGLRenderingContext && !! document.createElement( 'canvas' ).getContext( 'experimental-webgl' ); } catch( e ) { return false; } } )(),
	workers : !! window.Worker,
	fileapi : window.File && window.FileReader && window.FileList && window.Blob,

	getWebGLErrorMessage : function () {

		var domElement = document.createElement( 'div' );

		domElement.style.fontFamily = 'monospace';
		domElement.style.fontSize = '13px';
		domElement.style.textAlign = 'center';
		domElement.style.background = '#eee';
		domElement.style.position = 'relative';
		domElement.style.color = '#000';
		domElement.style.padding = '1em';
		domElement.style.width = '595px';
		domElement.style.margin = '4em auto 0';
		domElement.style.zIndex = '9999';
		domElement.id='detmes';
		domElement.className='detmes';
		
		if ( ! this.webgl ) {

			domElement.innerHTML = window.WebGLRenderingContext ? [
				'<div class="no3dclose" onmouseup="closeno3d()"></div>Sorry, your graphics card doesn\'t support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation">WebGL 3D</a> or WebGL is disabled<br/>Please try with',
				'<a href="http://www.google.com/chrome">Chrome</a>, ',
				'<a href="http://www.mozilla.org/es-ES/firefox/new/">Firefox 4+</a> or',
				'<a href="https://discussions.apple.com/thread/3300585?start=0&tstart=0">Webgl Safari</a>'
			].join( '\n' ) : [
				'<div class="no3dclose" onmouseup="closeno3d()"></div>Sorry, your browser doesn\'t support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation">WebGL 3D</a>  or WebGL is disabled<br/>',
				'Please try with',
				'<a href="http://www.google.com/chrome">Chrome</a>, ',
				'<a href="http://www.mozilla.org/es-ES/firefox/new/">Firefox 4+</a> or',
				'<a href="https://discussions.apple.com/thread/3300585?start=0&tstart=0">Webgl Safari</a>'
			].join( '\n' );

		}

		return domElement;

	},

	addGetWebGLMessage : function () {



		domElement = Detector.getWebGLErrorMessage();
		domElement.id = 'detmes';
       
		this.appendChild( domElement );

	}

};
