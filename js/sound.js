    var html5_audiotypes = { //define list of audio file extensions and their associated audio types. Add to it if your specified audio file isn't on this list:
    "mp3": "audio/mpeg",
    "mp4": "audio/mp4",
    "ogg": "audio/ogg",
    "wav": "audio/wav"
}

function createsoundbite(sound) {
    var html5audio = document.createElement('audio')
    if (html5audio.canPlayType) { //check support for HTML5 audio
        for (var i = 0; i < arguments.length; i++) {
            var sourceel = document.createElement('source')
            sourceel.setAttribute('src', arguments[i])
            if (arguments[i].match(/\.(\w+)$/i))
                sourceel.setAttribute('type', html5_audiotypes[RegExp.$1])
            html5audio.appendChild(sourceel)
        }
        html5audio.load()
        html5audio.playclip = function () {
            html5audio.pause()
            html5audio.currentTime = 0
            html5audio.play()
        }
        return html5audio
    }
    else {
        return { playclip: function () { throw new Error("Your browser doesn't support HTML5 audio unfortunately") } }
    }
}

//Initialize two sound clips with 1 fallback file each:
var soundIndependenceDay = createsoundbite("song1.ogg", "song1.mp3");
var sound1 = createsoundbite("firework.ogg", "firework.mp3");
var sound2 = createsoundbite("firework2.ogg", "firework2.mp3");
var sound3 = createsoundbite("firework3.ogg", "firework3.mp3");
