<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.1/mustache.min.js></script>
    <title>Kakao</title>
    <script>
        $(document).ready(function () {
            loadMemberList();
        })

        function loadMemberList() {
            $.ajax({
                type: 'POST',
                url: "getMemberList.php",
                data: {},
                dataType: 'text',
                cache: false,
                async: false
            })
                .done(function (result) {
                    let memberList = { "MEMBER": JSON.parse(result) };

                    var output = Mustache.render($("#divMemberList").html(), memberList);
                    $("#divMemberList").html(output);

                })
                .fail(function (result, status, error) {
                    alert("에러 :" + error);
                });
        }
        function login() {
            if (!document.getElementById("ddlMemberList").value) {
                alert("아이디를 입력해주세요");
                return false;
            }
            document.frm.submit();
        }

    </script>
</head>

<body>
    <div>
        <form name=frm method=post action="login_ok.php">
            <div id="divMemberList">
                <select name="ddlMemberList" id="ddlMemberList">
                    <option value=""> 아이디 선택 </option>
                    {{#MEMBER}}
                    {{#alias}}
                    <option value="{{memberCode}}">{{alias}}</option>
                    {{/alias}}
                    {{/MEMBER}}
                </select>
            </div>
        </form>
        <div>
            <button onclick="login();">로그인하기</button>
        </div>
    </div>
</body>

</html>