  
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <style>
            span.knet { float: right;}
        </style>
    </head>
 
    <body id="pdf-footer" onload="pagination()">
        <div>
            {{-- {{ $pageTitle or 'Page Title'}}&nbsp;  &nbsp; --}}
            @if(!empty($pageSubTitle))
                <small> {{ $pageSubTitle }} </small>
            @endif
            <span class="knet"><i>McSlide_Oms Reports</i></span>
        </div>
        <hr><br>
    </body>
</html>

    