{!! Form::open(['url' => route('locationWebViewUpdate', ['id' => $location->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
{!! Form::hidden('markdown', $location->mark_down, ['id' => 'markdown']) !!}
<!-- Create the editor container -->

<div id="editor-container"></div>

{!! Form::button('<i class="fa fa-save"></i> บันทึกบทความ' , ['class' => 'btn btn-primary btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
{!! Form::close() !!}

<!-- Initialize Quill editor -->

<script>

    $(document).ready(function () {
        var quill = new Quill("#editor-container", {
            modules: {
               // imageResize: {
                 //   displaySize: true
             //   },
                toolbar: [
                    [{header: [1, 2, false]}],
                    ["bold", "italic", "underline"],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    ["image", "code-block"]
                ]
            },
            placeholder: "Compose an epic...",
            theme: "snow" // or 'bubble'
        });

        var md = window.markdownit();
        md.set({
            html: true
        });

        var result = md.render(`{!! $location->mark_down !!}`);

        quill.clipboard.dangerouslyPasteHTML(result + "\n");

        // Need to do a first pass when we're passing in initial data.
        var html = quill.container.firstChild.innerHTML;
        const turndownService = new TurndownService();

        const markdown = turndownService.turndown(html);

        $("#markdown").val(markdown);

        // text-change might not be the right event hook. Works for now though.
        quill.on("text-change", function (delta, source) {

            var html = quill.container.firstChild.innerHTML;
            const turndownService = new TurndownService();

            const markdown = turndownService.turndown(html);

            $("#markdown").val(markdown);
        });
    });

    $(document).on("click", '#submitForm', (e) => {
        $('#' + e.target.id).prop('disabled', true);
        $('#mainForm').submit();
    })

</script>
