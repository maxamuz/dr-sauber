Drupal.behaviors.ytargetGoal = {};
Drupal.behaviors.ytargetGoal.ytargetSetGoal = function (settings) {
  var id = settings.ytargetId;
  var name = 'yaCounter' + id;
  if (window[name] !== undefined) {
    window[name].reachGoal(settings.ytargetGoal);
  }
  if ((settings.ytargetDev !== undefined) && settings.ytargetDev) {
    console.log('Сработала цель: "' + Drupal.settings.ytargetGoal + '"');
  }
}

if (Drupal.settings.ytargetId === undefined) {
  Drupal.behaviors.ytargetGoal.attach = function (context, settings) {
    this.ytargetSetGoal(settings);
  };
} else if ((Drupal.settings.ytargetId !== undefined) && (Drupal.settings.ytargetGoal !== undefined)) {
  Drupal.behaviors.ytargetGoal.ytargetSetGoal(Drupal.settings);
}
