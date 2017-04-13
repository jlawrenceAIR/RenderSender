var webPage = require('webpage');
var page = webPage.create(),
system = require('system'),
address, output, size;
address = system.args[1];
output = system.args[2];
uname = system.args[3];
password = system.args[4];
page.viewportSize = { width: 1280, height: 600 };

page.onError = function(msg, trace) {

  var msgStack = ['ERROR: ' + msg];

  if (trace && trace.length) {
    msgStack.push('TRACE:');
    trace.forEach(function(t) {
      msgStack.push(' -> ' + t.file + ': ' + t.line + (t.function ? ' (in function "' + t.function +'")' : ''));
    });
  }

  console.error(msgStack.join('\n'));

};

page.settings.userName = uname;
page.settings.password = password;
page.customHeaders={'Authorization': 'Basic '+btoa(uname+":"+password)};

page.open(address, function (status) {
if (status !== 'success') {
    console.log('Unable to load the address!');
    phantom.exit(1);
} else {
    window.setTimeout(function () {
        page.render(output);
        phantom.exit();
    }, 1000);
}
});
