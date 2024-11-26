{{-- <hr>
{{ Auth::user()->name }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}
Page [page] / [topage] {PAGENO} --}}


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <script>
        function pagination()
        {
                var vars = {};
                var x = document.location.search.substring(1).split('&');
 
                for (var i in x)
                {
                        var z = x[i].split('=', 2);
                        vars[z[0]] = unescape(z[1]);
                }
 
                var x = ['frompage','topage','page','webpage','section','subsection','subsubsection'];
 
                for (var i in x)
                {
                        var y = document.getElementsByClassName(x[i]);
 
                        for (var j = 0; j < y.length; ++j)
                        {
                                y[j].textContent = vars[x[i]];
                         }
                }
        }
        </script>
        <style>
            span.page { float: right; }
        </style>
    </head>
 
    <body id="pdf-footer" onload="pagination()">
        <hr>
        <div>
            <small>
                <span>
                    @auth
                        {{ Auth::user()->name }} -
                    @endauth 
                    {{ \Carbon\Carbon::now()->format('d-m-Y') }} 
                </span>
                <span class="page"></span>
            </small>
        </div>
    </body>
</html>