gdjs.loseCode = {};
gdjs.loseCode.localVariables = [];
gdjs.loseCode.GDGreenButtonObjects1= [];
gdjs.loseCode.GDGreenButtonObjects2= [];


gdjs.loseCode.eventsList0 = function(runtimeScene) {

{

gdjs.copyArray(runtimeScene.getObjects("GreenButton"), gdjs.loseCode.GDGreenButtonObjects1);

let isConditionTrue_0 = false;
isConditionTrue_0 = false;
for (var i = 0, k = 0, l = gdjs.loseCode.GDGreenButtonObjects1.length;i<l;++i) {
    if ( gdjs.loseCode.GDGreenButtonObjects1[i].IsPressed((typeof eventsFunctionContext !== 'undefined' ? eventsFunctionContext : undefined)) ) {
        isConditionTrue_0 = true;
        gdjs.loseCode.GDGreenButtonObjects1[k] = gdjs.loseCode.GDGreenButtonObjects1[i];
        ++k;
    }
}
gdjs.loseCode.GDGreenButtonObjects1.length = k;
if (isConditionTrue_0) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "NewScene", false);
}}

}


};

gdjs.loseCode.func = function(runtimeScene) {
runtimeScene.getOnceTriggers().startNewFrame();

gdjs.loseCode.GDGreenButtonObjects1.length = 0;
gdjs.loseCode.GDGreenButtonObjects2.length = 0;

gdjs.loseCode.eventsList0(runtimeScene);
gdjs.loseCode.GDGreenButtonObjects1.length = 0;
gdjs.loseCode.GDGreenButtonObjects2.length = 0;


return;

}

gdjs['loseCode'] = gdjs.loseCode;
