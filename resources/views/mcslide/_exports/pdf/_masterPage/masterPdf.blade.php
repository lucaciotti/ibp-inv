<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /* @page { font-size: pt }
                .keep-together {
                page-break-inside: avoid;
                }                
                .break-before {
                page-break-before: always;
                }                
                .break-after {
                page-break-after: always;
                }
             */
            @media print {
                .element-that-contains-table {
                    overflow: visible !important;
                }
            }
            p.page { page-break-after: always; }
            p.page:last-child { page-break-after: avoid; }
            div.row { font-size: 9pt; }
            span.floatleft { float: left; width: 49%; } /* border-left:1px solid grey; */
            span.floatright { float: right; width: 49%; }
            span.floatleft20 { float: left; width: 25%; } 
            span.floatright20 { float: right; width: 25%; }
            span.floatright80 { float: right; width: 75%; }
            hr.divider { width: 80%; float:left; margin-right: 20%;}
            hr.smalldivider { width: 50%; float:left; margin-right: 50%;}
            hr.dividerPage { width: 80%; float:middle; margin-right: 10%;}
            dt { font-size: 8pt; font-style: italic; }
            a { text-decoration: none; }
            a.black { color: #000; }
            table { width: 100%; font-size: 9pt; }
            table tr { page-break-inside: avoid; }
            table .fontsmall { font-size:  8pt; }
            table .centered { text-align: center; }
            table tr:nth-child(even) { background-color: #f2f2f2; }
            table tr.danger { background-color: red; }
            table tr.warning { background-color: orange; }
            table thead { display: table-header-group; }
            table tbody { display: table-header-group; } 
            table tbody th { background-color: lightgrey; }
            table tbody td.green { background-color: #cef2bc; }
            table tbody td.orange { background-color: #f0d45e; }
            table tbody td.red { background-color: #ffb3b3; }
            table tfoot { background-color: darkgrey; display: table-header-group; }
            table tfoot th.orange { background-color: #f0d45e; }
            div.contentTitle { 
                font-size: 11pt; 
                font-stretch: expanded; 
                font-style: oblique; 
                margin-left: 20px; 
                font-weight: bold; 
                text-decoration: underline; 
                padding-top: 15px;
                padding-bottom: 15px;
            }
            span.contentSubTitle {
                font-size: 10pt;
                font-weight: bold;
                font-stretch: expanded;
                font-style: oblique;
                text-decoration: underline;
            }
            
            /* Style the container with a rounded border, grey background and some padding and margin */
            .containerEvent {
                border: 2px solid #ccc;
                background-color: #f0f0f0;
                border-radius: 5px;
                padding: 10px;
                padding-left: 20px;
                margin: 10px 0;
            }

            /* Clear floats after containers */
            .containerEvent::after {
                content: "";
                clear: both;
                display: table;
            }

            /* Float images inside the container to the left. Add a right margin, and style the image as a circle */
            .containerEvent img {
                float: left;
                margin-right: 20px;
                border-radius: 50%;
            }

            /* Increase the font-size of a span element */
            .containerEvent span {
                font-size: 20px;
                margin-right: 15px;
            }
        </style>
    </head>
    <body>
        
       {{--  @section('pdf-header')
            @include('_exports.pdf.masterPage.headerPdf')
        @show

        @section('pdf-footer')
            @include('_exports.pdf.masterPage.footerPdf')
        @show --}}

        @yield('pdf-main')        

        @stack('scripts')
    </body>
</html>