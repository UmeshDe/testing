<html>
<head>
    <title>
        Test Report
    </title>
    <style type="text/css">


        @page { margin: 100px 25px; }
        header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
        footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
        p { page-break-after: always; }
        p:last-child { page-break-after: never; }


        .test-result-table {

            border: 1px solid black;
            width: 800px;
        }

        .test-result-table-header-cell {

            border-bottom: 1px solid black;
            background-color: silver;
        }

        .test-result-step-command-cell {

            border-bottom: 1px solid gray;
        }

        .test-result-step-description-cell {

            border-bottom: 1px solid gray;
        }

        .test-result-step-result-cell-ok {

            border-bottom: 1px solid gray;
            background-color: green;
        }

        .test-result-step-result-cell-failure {

            border-bottom: 1px solid gray;
            background-color: red;
        }

        .test-result-step-result-cell-notperformed {

            border-bottom: 1px solid gray;
            background-color: white;
        }

        .test-result-describe-cell {
            background-color: tan;
            font-style: italic;
        }

        .test-cast-status-box-ok {
            border: 1px solid black;
            float: left;
            margin-right: 10px;
            width: 45px;
            height: 25px;
            background-color: green;
        }

    </style>
</head>
<body>

<header>header on each page</header>
<footer>
    <script type="text/php">
        if ( isset($pdf) ) {
            $font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        }
</script></footer>
<h1 class="test-results-header">
    Test Report
</h1>

<table class="test-result-table" cellspacing="0">
    <thead>
    <tr>
        <td class="test-result-table-header-cell">
            Test Case
        </td>
        <td class="test-result-table-header-cell">
            Description
        </td>
        <td class="test-result-table-header-cell">
            Result
        </td>
    </tr>
    </thead>
    <tbody>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            open /
        </td>
        <td class="test-result-step-description-cell">
            Open browser to "/"
        </td>
        <td class="test-result-step-result-cell-ok">
            OK
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            asasdasd
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-comment-row">
        <td class="test-result-describe-cell" colspan="3">
            Describe: This is a comment
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-alttwo">
        <td class="test-result-step-command-cell">
            click btnG
        </td>
        <td class="test-result-step-description-cell">
            Click on page element with identifier of "btnG"
        </td>
        <td class="test-result-step-result-cell-failure">
            FAILURE - Unable to find element named "btnG"
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            assertTitle something
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    <tr class="test-result-step-row test-result-step-row-altone">
        <td class="test-result-step-command-cell">
            asasdasd
        </td>
        <td class="test-result-step-description-cell">
            Test that the title of the page is "something"
        </td>
        <td class="test-result-step-result-cell-notperformed">
            NOT PERFORMED
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>