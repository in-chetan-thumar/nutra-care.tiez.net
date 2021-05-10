google.load("elements", "1", {
    packages: "transliteration"
});

function onLoad() {
    var options = {
        sourceLanguage:
            google.elements.transliteration.LanguageCode.ENGLISH,
        destinationLanguage:
            [google.elements.transliteration.LanguageCode.GUJARATI],
        shortcutKey: 'ctrl+g',
        transliterationEnabled: true
    };

    // Create an instance on TransliterationControl with the required
    // options.
    var control =
        new google.elements.transliteration.TransliterationControl(options);

    // Enable transliteration in the textbox with id
    // 'transliterateTextarea'.

    $('.googleGu').each(function(){
        var id = this.id;
        control.makeTransliteratable([id]);
    })

    //control.makeTransliteratable(['gujarati_input']);
}
google.setOnLoadCallback(onLoad);