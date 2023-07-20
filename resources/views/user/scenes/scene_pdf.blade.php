<!DOCTYPE html>
<html>

<head>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <table>
            <tr>
                <td>
                    <img src="{{ $scene->scene_canvas_image?->url ?? url('images/scenesnapshot.png') }}" alt="image">
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
