console.log("Version: v300");


var videoId = "9GfbWtNE_Gg"; //"kkIBqOeCnDQ";
var videopl = "PLblpoCXGceknIs1woLzlyk_aj1MV7imiy";

var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var mIsAdPlayerEnabled = false;

var videoPlayerWidth = 1200;
var videoPlayerHeight = 480;
var adPlayerWidth = 400;
var adPlayerHeight = 320;

var pageFixedHeaderHt = 95;
var pageHeaderHt = pageFixedHeaderHt;
var playerFixedHt = 0;

var adplayer = false;

function onYouTubeIframeAPIReady() {


    $(document).ready(function() {

        recalcPlayerDimens();

        loadVideoPlayer();

        if(mIsAdPlayerEnabled) loadAdPlayer();

    });


}

function recalcPlayerDimens() {


    var winWidth = $(document).width();
    var winHt = $(window).height();
    console.log("winWidth: " + winWidth + ", winHt: " + winHt);

    if (!isNaN(winWidth)) {
        videoPlayerWidth = winWidth;

        winWidth = winWidth - 160;
        //winHt = winHt - 95;

        console.log("winWidth: " + winWidth + ", winHt: " + winHt);

        var fullplayer = true;
        var threeParts = winWidth / 3;
        if (winWidth <= 960) {
            threeParts = winWidth / 2;
            fullplayer = false;
        }
        
        

        var sPlayerW = mIsAdPlayerEnabled ? threeParts * 2 : winWidth;
        sPlayerW = Math.min(videoPlayerWidth, sPlayerW);
        var sPlayerHt = sPlayerW * 9 / 16;
        sPlayerHt = Math.min(sPlayerHt, winHt);

        var aPlayerW = fullplayer ? (sPlayerW / 2) : sPlayerW;
        var aPlayerHt = aPlayerW * 9 / 16;

        console.log("sPlayerW: " + sPlayerW + ", sPlayerHt: " + sPlayerHt);
        console.log("aPlayerW: " + aPlayerW + ", aPlayerHt: " + aPlayerHt);

        videoPlayerWidth = parseInt(sPlayerW);
        videoPlayerHeight = parseInt(sPlayerHt);

        adPlayerWidth = parseInt(aPlayerW);
        adPlayerHeight = parseInt(aPlayerHt);

        if (fullplayer) {
            videoPlayerHeight = parseInt(winHt);
            adPlayerHeight = parseInt(winHt);

            playerFixedHt = winHt;
        }


        if(!mIsAdPlayerEnabled) {
            $('#adframe').hide();
        }

        if(false)
        {
            pageHeaderHt = fullplayer ? 0 : pageFixedHeaderHt;
            $(window).scrollTop(pageHeaderHt);
            if(fullplayer)
            {
                $('body').addClass('fixfortv');
                $('#jcHeader').addClass('floating');
            }
            else
            {
                $('body').removeClass('fixfortv');
                $('#jcHeader').removeClass('floating');
            }
        }

    }



}

function loadVideoPlayer() {
    ytplayer = new YT.Player('player_iframe', {
            height: videoPlayerHeight,
            width: videoPlayerWidth,
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            },
            playerVars: {
                'autoplay': 1,
                'rel': 0,
                'showinfo': 0,
                'showsearch': 0,
                'controls': 2,
                'loop': 1,
                'enablejsapi': 1,
                'iv_load_policy': 3,
                'playlist': videoId,
                'list': videopl,
                'modestbranding': 1
            },
            videoId: videoId
        });

}

function onPlayerStateChange(event) {

    if (event.data == YT.PlayerState.PLAYING) {
        console.log("Video playing");
        removeAdVolume();
    } else if (event.data == YT.PlayerState.PAUSED) {
        console.log("Video pause");
        removeAdVolume();
    } else {
        console.log("Video not playing");
        setAdVolume();
    }
}

function onPlayerReady(event) {
    executeVideoPlayer();
    event.target.setShuffle(true);
    event.target.setPlaybackQuality('highres');
}

function executeVideoPlayer() {
    //var videoAr = [videoId];
    //ytplayer.loadPlaylist(videoAr);

    loadTVJS();
}



var advideoId = "6uOhHv18qE0";
var advideopl = "PLblpoCXGceknymYijysp-6RuM6OLShcWx";

function loadAdPlayer() {

    //suggestedQuality parameter value can be small, medium, large, hd720, hd1080, highres or default

    adplayer = new YT.Player('ad_iframe', {
            height: adPlayerHeight,
            width: adPlayerWidth,
            enablejsapi: 1,
            events: {
                'onReady': onAdPlayerReady
            },
            playerVars: {
                'autoplay': 1,
                'rel': 0,
                'showinfo': 0,
                'showsearch': 0,
                'controls': 0,
                'loop': 1,
                'enablejsapi': 1,
                'playlist': advideoId,
                'list': advideopl,
                'modestbranding': 1
            },
            videoId: advideoId
        });
}


function onAdPlayerReady(event) {
    event.target.mute();
    event.target.setPlaybackQuality('small');
    event.target.setShuffle(true);
    executeAd();
}

function executeAd() {
    var advideoAr = [advideoId];
}

var userOnAdArea = false;

function loadTVJS() {

    $(document).ready(function() {
        console.log("win scroll");
        $(window).scrollTop(pageHeaderHt);
        setupTVPageScroll();


        $('#ad_iframe').mouseenter(function() {
            console.log("mouseenter");
            userOnAdArea = true;
            setAdVolume();

        }).mouseleave(function() {
            console.log("mouseleave");
            userOnAdArea = false;
            removeAdVolume();
        });

        var lastPolledVal = $(window).height() + $(window).width();

        var timer = new JCL_timer();
        timer.setDelayTime(2000);
        timer.setCallBack(function() {
            var curPolledVal = $(window).height() + $(window).width();
            console.log("resize player dimens: " + curPolledVal);
            recalcPlayerDimens();

            if (ytplayer) {
                ytplayer.setSize(videoPlayerWidth, videoPlayerHeight);
            }

            if (adplayer) {
                adplayer.setSize(adPlayerWidth, adPlayerHeight);
            }

        });

        $(window).resize(function() {
            timer.update($(this));
        });

    });

}

function setAdVolume() {
    if(!adplayer) return;
    
    adplayer.unMute();
    adplayer.setVolume(ytplayer.getVolume());
}

function removeAdVolume() {
    if(!adplayer) return;
    
    if (userOnAdArea) return;

    adplayer.mute();
}

function setupTVPageScroll() {


}
