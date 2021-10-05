google.load("elements", "1", {
        packages: "transliteration"
    });

	//Get ids as dynamic
	var ids = [];
	$( ".lang_trans" ).each(function() {
		ids.push($( this ).attr( "id" ));
		if($(this).hasClass("tinymce")){
			ids.push($( this ).attr( "id" )+"_ifr");
		}
	});

    function onLoad() {
        var lang;
        var options = {
            sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage: [google.elements.transliteration.LanguageCode.MALAYALAM],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

        // Create an instance on TransliterationControl with the required
        // options.
        var control =
            new google.elements.transliteration.TransliterationControl(options);


        //var ids = ["query_title_lang1","question_lang1","answer_lang1"];

        control.makeTransliteratable(ids);
        control.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);


    }
    google.setOnLoadCallback(onLoad);