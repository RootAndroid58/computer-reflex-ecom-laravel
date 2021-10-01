// Cart Event GLobal Broadcast Listner 
if ($('meta[name=user-id]').length) {
    var CartEventChannel = Echo.private(`CartEvent.User.${$('meta[name=user-id]').attr('content')}`)
} else {
    var CartEventChannel = Echo.channel(`CartEvent.Session.${$('meta[name=session-id]').attr('content')}`);
}

CartEventChannel.listen('CartEvent', (e) => cartEvent(e.data)); 



