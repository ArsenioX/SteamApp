gdjs.loseCode = {};
gdjs.loseCode.localVariables = [];
gdjs.loseCode.GDkalahObjects1= [];
gdjs.loseCode.GDkalahObjects2= [];
gdjs.loseCode.GDEmptyMonitorObjects1= [];
gdjs.loseCode.GDEmptyMonitorObjects2= [];
gdjs.loseCode.GDBlueButtonObjects1= [];
gdjs.loseCode.GDBlueButtonObjects2= [];


gdjs.loseCode.eventsList0 = function(runtimeScene) {

{

gdjs.copyArray(runtimeScene.getObjects("BlueButton"), gdjs.loseCode.GDBlueButtonObjects1);

let isConditionTrue_0 = false;
isConditionTrue_0 = false;
for (var i = 0, k = 0, l = gdjs.loseCode.GDBlueButtonObjects1.length;i<l;++i) {
    if ( gdjs.loseCode.GDBlueButtonObjects1[i].IsClicked((typeof eventsFunctionContext !== 'undefined' ? eventsFunctionContext : undefined)) ) {
        isConditionTrue_0 = true;
        gdjs.loseCode.GDBlueButtonObjects1[k] = gdjs.loseCode.GDBlueButtonObjects1[i];
        ++k;
    }
}
gdjs.loseCode.GDBlueButtonObjects1.length = k;
if (isConditionTrue_0) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "FullSokobanGame", false);
}}

}


};

gdjs.loseCode.func = function(runtimeScene) {
runtimeScene.getOnceTriggers().startNewFrame();

gdjs.loseCode.GDkalahObjects1.length = 0;
gdjs.loseCode.GDkalahObjects2.length = 0;
gdjs.loseCode.GDEmptyMonitorObjects1.length = 0;
gdjs.loseCode.GDEmptyMonitorObjects2.length = 0;
gdjs.loseCode.GDBlueButtonObjects1.length = 0;
gdjs.loseCode.GDBlueButtonObjects2.length = 0;

gdjs.loseCode.eventsList0(runtimeScene);
gdjs.loseCode.GDkalahObjects1.length = 0;
gdjs.loseCode.GDkalahObjects2.length = 0;
gdjs.loseCode.GDEmptyMonitorObjects1.length = 0;
gdjs.loseCode.GDEmptyMonitorObjects2.length = 0;
gdjs.loseCode.GDBlueButtonObjects1.length = 0;
gdjs.loseCode.GDBlueButtonObjects2.length = 0;


return;

}

gdjs['loseCode'] = gdjs.loseCode;
