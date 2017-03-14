import 'picturefill'
import 'lazysizes/plugins/bgset/ls.bgset'
import 'lazysizes'
import './components'

import FontFaceObserver from 'fontfaceobserver'

// Optimization for Repeat Views
if( sessionStorage.criticalFoftDataUriFontsLoaded ) {
  document.documentElement.className += " fonts-stage-1 fonts-stage-2";
} else {
  var fontASubset = new FontFaceObserver("Proxima Nova Subset");

  Promise.all([fontASubset.load()]).then(function () {
    document.documentElement.className += " fonts-stage-1";

    var fontA = new FontFaceObserver('Proxima Nova', { weight: 100 });
    var fontB = new FontFaceObserver('Proxima Nova', { weight: 300 });
    var fontC = new FontFaceObserver('Proxima Nova', { weight: 600 });
    var fontD = new FontFaceObserver('Proxima Nova', { weight: 800 });

    Promise.all([fontA.load(), fontB.load(), fontC.load(), fontD.load()]).then(function () {
      document.documentElement.className += " fonts-stage-2";

      // Optimization for Repeat Views
      sessionStorage.criticalFoftDataUriFontsLoaded = true;
    });
  });
}
