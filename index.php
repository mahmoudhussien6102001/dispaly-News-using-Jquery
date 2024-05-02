<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        table {
         
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        tr:hover{
            background-color: #f2f2f2;
        }
        </style>
</head>
<body>
    <button id="nextbtn" >Next</button>
    <table id="content"></table>
    <script src="jquery-3.7.1.min.js"></script>
    <script>
        $(function() {
            var $nextbtn = $('#nextbtn');
            var $content = $('#content');
            var startindex = 0;
            var prepage = 4;
            var allnews= [];

            $nextbtn.on('click', function() {
                displaynews();
            });

            function getnews() {
                $.ajax({
                    url: 'data.php',
                    type: 'GET',
                    success: function(data) {
                        allnews= data;
                        displaynews();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            function displaynews() {
                var endpage = startindex + prepage;
                var newsShow = [];
                for (let i = startindex; i < endpage && i < allnews.length; i++) {
                    newsShow.push(allnews[i]);
                }
                if (newsShow.length === 0) {
                    $nextbtn.prop('disabled', true);
                    return;
                }
                newdata(newsShow);
                startindex += endpage;
            }

            function newdata(newsShow) {
                $content.empty();
                var table = $('<table>');
                var headerRow = $('<tr>').append($('<th>').text('Title'), $('<th>').text('Content'),$('<th>').text('Published_date'));
                table.append(headerRow);
                for (let i = 0; i < newsShow.length; i++) {
                    var productRow = $('<tr>').append($('<td>').text(newsShow[i].Title), $('<td>').text(newsShow[i].Content), $('<td>').text(newsShow[i].Published_date));
                    table.append(productRow);
                }
                $content.append(table);
            }

            getnews();
        });
    </script>
</body>
</html>