gdjs.TamatCode = {};
gdjs.TamatCode.localVariables = [];
gdjs.TamatCode.GDNewSpriteObjects1= [];
gdjs.TamatCode.GDNewSpriteObjects2= [];
gdjs.TamatCode.GDSelamatObjects1= [];
gdjs.TamatCode.GDSelamatObjects2= [];
gdjs.TamatCode.GDDinoVitaObjects1= [];
gdjs.TamatCode.GDDinoVitaObjects2= [];
gdjs.TamatCode.GDDinoMortObjects1= [];
gdjs.TamatCode.GDDinoMortObjects2= [];
gdjs.TamatCode.GDDinoDouxObjects1= [];
gdjs.TamatCode.GDDinoDouxObjects2= [];
gdjs.TamatCode.GDDinoShadowObjects1= [];
gdjs.TamatCode.GDDinoShadowObjects2= [];
gdjs.TamatCode.GDDinoLenaObjects1= [];
gdjs.TamatCode.GDDinoLenaObjects2= [];
gdjs.TamatCode.GDPlayerObjects1= [];
gdjs.TamatCode.GDPlayerObjects2= [];
gdjs.TamatCode.GDGreenButtonObjects1= [];
gdjs.TamatCode.GDGreenButtonObjects2= [];


gdjs.TamatCode.eventsList0 = function(runtimeScene) {

{

gdjs.copyArray(runtimeScene.getObjects("GreenButton"), gdjs.TamatCode.GDGreenButtonObjects1);

let isConditionTrue_0 = false;
isConditionTrue_0 = false;
for (var i = 0, k = 0, l = gdjs.TamatCode.GDGreenButtonObjects1.length;i<l;++i) {
    if ( gdjs.TamatCode.GDGreenButtonObjects1[i].IsClicked((typeof eventsFunctionContext !== 'undefined' ? eventsFunctionContext : undefined)) ) {
        isConditionTrue_0 = true;
        gdjs.TamatCode.GDGreenButtonObjects1[k] = gdjs.TamatCode.GDGreenButtonObjects1[i];
        ++k;
    }
}
gdjs.TamatCode.GDGreenButtonObjects1.length = k;
if (isConditionTrue_0) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "FullSokobanGame", false);
}}

}


};

gdjs.TamatCode.func = function(runtimeScene) {
runtimeScene.getOnceTriggers().startNewFrame();

gdjs.TamatCode.GDNewSpriteObjects1.length = 0;
gdjs.TamatCode.GDNewSpriteObjects2.length = 0;
gdjs.TamatCode.GDSelamatObjects1.length = 0;
gdjs.TamatCode.GDSelamatObjects2.length = 0;
gdjs.TamatCode.GDDinoVitaObjects1.length = 0;
gdjs.TamatCode.GDDinoVitaObjects2.length = 0;
gdjs.TamatCode.GDDinoMortObjects1.length = 0;
gdjs.TamatCode.GDDinoMortObjects2.length = 0;
gdjs.TamatCode.GDDinoDouxObjects1.length = 0;
gdjs.TamatCode.GDDinoDouxObjects2.length = 0;
gdjs.TamatCode.GDDinoShadowObjects1.length = 0;
gdjs.TamatCode.GDDinoShadowObjects2.length = 0;
gdjs.TamatCode.GDDinoLenaObjects1.length = 0;
gdjs.TamatCode.GDDinoLenaObjects2.length = 0;
gdjs.TamatCode.GDPlayerObjects1.length = 0;
gdjs.TamatCode.GDPlayerObjects2.length = 0;
gdjs.TamatCode.GDGreenButtonObjects1.length = 0;
gdjs.TamatCode.GDGreenButtonObjects2.length = 0;

gdjs.TamatCode.eventsList0(runtimeScene);
gdjs.TamatCode.GDNewSpriteObjects1.length = 0;
gdjs.TamatCode.GDNewSpriteObjects2.length = 0;
gdjs.TamatCode.GDSelamatObjects1.length = 0;
gdjs.TamatCode.GDSelamatObjects2.length = 0;
gdjs.TamatCode.GDDinoVitaObjects1.length = 0;
gdjs.TamatCode.GDDinoVitaObjects2.length = 0;
gdjs.TamatCode.GDDinoMortObjects1.length = 0;
gdjs.TamatCode.GDDinoMortObjects2.length = 0;
gdjs.TamatCode.GDDinoDouxObjects1.length = 0;
gdjs.TamatCode.GDDinoDouxObjects2.length = 0;
gdjs.TamatCode.GDDinoShadowObjects1.length = 0;
gdjs.TamatCode.GDDinoShadowObjects2.length = 0;
gdjs.TamatCode.GDDinoLenaObjects1.length = 0;
gdjs.TamatCode.GDDinoLenaObjects2.length = 0;
gdjs.TamatCode.GDPlayerObjects1.length = 0;
gdjs.TamatCode.GDPlayerObjects2.length = 0;
gdjs.TamatCode.GDGreenButtonObjects1.length = 0;
gdjs.TamatCode.GDGreenButtonObjects2.length = 0;


return;

}

gdjs['TamatCode'] = gdjs.TamatCode;
