// Cart Event GLobal Broadcast Listner 
if ($('meta[name=user-id]').length) {
    var QuickActionEventChannel = Echo.private(`QuickActionEvent.User.${$('meta[name=user-id]').attr('content')}`)
} else {
    var QuickActionEventChannel = Echo.channel(`QuickActionEvent.Session.${$('meta[name=session-id]').attr('content')}`);
}

QuickActionEventChannel.listen('QuickActionEvent', (e) => window[e.data.type + 'Event'](e.data)); 



