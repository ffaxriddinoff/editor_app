<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Editor</title>
</head>

<body style="height: 600px">

{{--@dd($config['editorConfig']['callbackUrl'])--}}
<div id="placeholder"></div>
<script type="text/javascript" src="http://localhost:8080/web-apps/apps/api/documents/api.js"></script>
<script type="text/javascript">

    window.docEditor = new DocsAPI.DocEditor("placeholder", {
        "document": {
            "fileType": "{{ $config['document']['fileType'] }}",
            "key": "{{ $config['document']['key'] }}",
            "title": "{{ $config['document']['title'] }}",
            "url": "{{ $config['document']['url'] }}",
        },
        "editorConfig": {
            "callbackUrl": "{{ $config['editorConfig']['callbackUrl'] }}"
        },
        "documentType": "word",
        "token": "{{ $config['editorConfig']['token'] }}",
    });

    var connector = docEditor.createConnector()
    console.log(connector)
</script>
</body>
</html>
