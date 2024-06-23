<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Editor</title>
</head>

<body style="height: 600px">


<div id="placeholder"></div>
<script type="text/javascript" src="{{ $js_url }}"></script>

<script type="text/javascript">
    var docEditor;

    var connectEditor = function () {
        docEditor = new DocsAPI.DocEditor("placeholder", {
            "type": "desktop",
            "documentType": "word",
            "document": {
                "fileType": "{{ $config['document']['fileType'] }}",
                "key": "{{ $config['document']['key'] }}",
                "title": "{{ $config['document']['title'] }}",
                "url": "{{ $config['document']['url'] }}",
            },
            "editorConfig": {
                "mode": "edit",
                "callbackUrl": "{{ $config['editorConfig']['callbackUrl'] }}"
            },
            "token": "{{ $token }}",
        });
    }

    if (window.addEventListener) {
        window.addEventListener("load", connectEditor);
    } else if (window.attachEvent) {
        window.attachEvent("load", connectEditor);
    }

</script>
</body>
</html>
