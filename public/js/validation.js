/* This function accepts
* @inputId_ (the string value of the input u want to validate)
* @messageID_ where you want the error message for that input to show probably a span or div
* @validation type includes :required|file:[extenstion u want to allow comma seprated]|numeric|min:2|email|alpha
* type is optional only when passing radio boxes
* when passing radioboxes the inputID_ will accept the name of the radio box
* example:
* FOR TEXT
* <input type="text" id="name" name="name">
* <span id="nameMsg"></span>
*FOR FILE
* <input type="file" id="upload" name="upload">
* <span id="uploadMsg"></span>
*
* FOR RADIO (pass the name not the id )
*   <input type="radio" name="age" value="30"> 0 - 30<br>
* <input type="radio" name="age" value="60"> 31 - 60<br>
*  <input type="radio" name="age" value="100"> 61 - 100<br>
* <span id="ageMsg"></span>
*  <script>
*         baildateForm('name', 'nameMsg', "required|min:2|alpha");
*         baildateForm('upload', 'uploadMsg', "required|file:[pdf,docx]");
*         baildateForm('age', 'ageMsg', "required|",'radio');
*  </script>
* */
function validationForm(inputID_, messageID_, validationType, type ='text', showMessage = true) {
    let inputID = $("#" + inputID_);
    let messageID = $("#" + messageID_);
    let flag = true;
    let validationList = validationType.split("|");
    let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var testAplha = /^[a-zA-Z\s]+$/;
    var testNumberic = /^[0-9\s]+$/;

    for (let vlad in validationList)
    {
        if (validationList[vlad] == 'none')
        {
            flag = true;
        }

        if (type == 'radio')
        {
            let myRadio = $("input[name="+inputID_+"]");
            let checkedValue = myRadio.filter(":checked").val();
            let isChecked= myRadio.is(":checked");
            if (flag)
            {
                if (!isChecked)
                {
                    messageID.removeClass('balid-feedback');

                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please check an option.");
                    flag = false;
                }
                else {

                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");
                    messageID.addClass('balid-feedback');
                    if(showMessage)
                    {
                        messageID.html("You have selected: "+checkedValue);
                    }
                    flag = true;
                }
            }
        }
        if (type == 'checkbox')
        {
            let myCheckBox = $("input[name="+inputID_+"]");
            let isChecked= myCheckBox.is(':checked');
            if (flag) {
                if (!isChecked) {
                    messageID.removeClass('balid-feedback');
                    inputID.removeClass('balid')

                    inputID.addClass("inbalid");
                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please check an option.");
                    flag = false;
                } else {
                    let checkBoxItems = [];
                    $.each($("input[name=" + inputID_ + "]:checked"), function () {
                        checkBoxItems.push($(this).val());
                    });

                    messageID.removeClass('inbalid-feedback');
                    inputID.removeClass('inbalid');
                    messageID.html("");

                    messageID.addClass('balid-feedback');
                    if (showMessage)
                    {
                        messageID.html("You have selected: " + checkBoxItems.join(", "));
                    }
                    flag = true;
                }
            }
        }

        if (type == 'select')
        {
            if (flag)
            {
                if(inputID.val() == "")
                {
                    messageID.removeClass('balid-feedback');
                    inputID.removeClass('balid');

                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please check an option.");
                    flag = false;
                }
                else
                {
                    messageID.removeClass('inbalid-feedback');
                    inputID.removeClass('inbalid');
                    messageID.html("");

                    messageID.addClass('balid-feedback');
                    inputID.addClass('balid');
                    if (showMessage)
                    {
                        messageID.html("You have selected: " + inputID.val() );
                    }

                    flag = true;
                }
            }
        }

        if (validationList[vlad] == 'required'  && (type !='radio' &&  type !='checkbox' &&  type !='select'))
        {
            if (flag)
            {
                if ((inputID.val() == '')) {
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');

                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please fill out this field.");
                    flag = false;
                } else {
                    inputID.removeClass('inbalid');
                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");

                    inputID.addClass('balid');
                    messageID.addClass('balid-feedback');
                    flag = true;
                }
            }
        }

        if (validationList[vlad] == 'alpha')
        {
            if (flag)
            {
                if ((!inputID.val().replace(/\s/g, '').length))
                {
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');
                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("This field only allows Alphabets.");
                    flag = false;
                }else{
                    inputID.removeClass('inbalid');
                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");

                    inputID.addClass('balid');
                    messageID.addClass('balid-feedback');
                    flag = true;
                }
            }
            if (flag)
            {
                if (!testAplha.test(inputID.val())) {
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');
                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("This field only allows alphabetic input.");
                    flag = false;
                } else {
                    inputID.removeClass('inbalid');
                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");

                    inputID.addClass('balid');
                    messageID.addClass('balid-feedback');
                    flag = true;
                }
            }
        }

        if (validationList[vlad] == 'email')
        {
            if (flag)
            {
                if (!testEmail.test(inputID.val()))
                {
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');

                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please enter valid email address");
                    flag = false;
                } else {
                    inputID.removeClass('inbalid');
                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");

                    inputID.addClass('balid');
                    messageID.addClass('balid-feedback');
                    flag = true;
                }
            }
        }

        if (validationList[vlad] == 'numeric')
        {
            if (flag)
            {
                if (!testNumberic.test(inputID.val()))
                {

                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');

                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("This field only accepts numeric input");
                    flag = false;
                } else {

                    inputID.removeClass('inbalid');
                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");

                    inputID.addClass('balid');
                    messageID.addClass('balid-feedback');
                    flag = true;
                }

            }
        }

        if (validationList[vlad].includes('min:'))
        {
            let minimumChar = validationList[vlad].split(":");
            if (minimumChar[0] == 'min')
            {
                if (flag)
                {
                    try {
                        if (inputID.val().length < parseInt(minimumChar[1]))
                        {
                            inputID.removeClass('balid');
                            messageID.removeClass('balid-feedback');
                            inputID.addClass('inbalid');
                            messageID.addClass('inbalid-feedback');
                            messageID.html("This field requires at least " + minimumChar[1] + " characters.");
                            flag = false;
                        } else {
                            inputID.removeClass('inbalid');
                            messageID.removeClass('inbalid-feedback');
                            messageID.html("");

                            inputID.addClass('balid');
                            messageID.addClass('balid-feedback');
                            flag = true;
                        }
                    }catch (e) {
                        if (inputID.text().length < parseInt(minimumChar[1]))
                        {
                            inputID.removeClass('balid');
                            messageID.removeClass('balid-feedback');
                            inputID.addClass('inbalid');
                            messageID.addClass('inbalid-feedback');
                            messageID.html("This field requires at least " + minimumChar[1] + " characters.");
                            flag = false;
                        } else {
                            inputID.removeClass('inbalid');
                            messageID.removeClass('inbalid-feedback');
                            messageID.html("");

                            inputID.addClass('balid');
                            messageID.addClass('balid-feedback');
                            flag = true;
                        }
                    }

                }
            }
        }

        //single file
        if (validationList[vlad].includes('file'))
        {
            let minimumCharFile = validationList[vlad].split(":");
            if (minimumCharFile[0] == 'file')
            {
                if (flag)
                {
                    let minimumCharFileRemoveSquare = minimumCharFile[1].replace("[","").replace("]","").split(',').toString();
                    let ValidFileExtrray = minimumCharFileRemoveSquare.split(",");
                    let fileNameExt = inputID.val().substr(inputID.val().lastIndexOf('.') + 1).toLowerCase();

                    if ($.inArray(fileNameExt, ValidFileExtrray) == -1)
                    {
                        inputID.removeClass('balid');
                        messageID.removeClass('balid-feedback');

                        inputID.addClass('inbalid');
                        messageID.addClass('inbalid-feedback');
                        messageID.html("Invalid file format. Accepted formats are: "+ minimumCharFileRemoveSquare);
                        flag = false;
                    }else{
                        inputID.removeClass('inbalid');
                        messageID.removeClass('inbalid-feedback');
                        messageID.html("");

                        inputID.addClass('balid');
                        messageID.addClass('balid-feedback');
                        messageID.html(inputID.val().match(
                            /[\/\\]([\w\d\s\.\-\(\)]+)$/
                        )[1]);

                        flag = true;
                    }
                }
            }
        }

        if (validationList[vlad].includes('fileSize'))
        {
            if(flag)
            {
                let nameofFile = inputID.attr('name');
                let file = $("input[name="+nameofFile+"]").get(0).files[0];
                let fileSize = validationList[vlad].split(":");

                let FileSizeRemoveSquares = fileSize[1].replace("[","").replace("]","").split(',').toString();

                if(file.size > parseInt(FileSizeRemoveSquares*1000000))
                {
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');

                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please upload file less than: "+ FileSizeRemoveSquares.toString() + "MB" );
                    flag = false;
                }else{
                    inputID.removeClass('inbalid');
                    messageID.removeClass('inbalid-feedback');
                    messageID.html("");

                    inputID.addClass('balid');
                    messageID.addClass('balid-feedback');
                    messageID.html(inputID.val().match(
                        /[\/\\]([\w\d\s\.\-\(\)]+)$/
                    )[1]);

                    flag = true;
                }
            }
        }
        // \\single file

        //Multiple file
        if (validationList[vlad].includes('multifile'))
        {
            let minimumCharFiles = validationList[vlad].split(":");
            let minimumCharFileRemoveSquare = minimumCharFiles[1].replace("[","").replace("]","").split(',').toString();
            let ValidFileExtrray = minimumCharFileRemoveSquare.split(",");
            if (minimumCharFiles[0] == 'multifile')
            {
                let nameofFile = inputID.attr('name');
                let file = $("input[name="+nameofFile+"]").get(0).files[0];
                let displaySuccessText =[];



                let selection = document.getElementById(inputID_);
                let count = 0;
                for (let i=0; i<selection.files.length; i++)
                {
                    let fileNameExt = selection.files[i].name.split('.').pop().toLowerCase();
                    if ($.inArray(fileNameExt, ValidFileExtrray) == -1)
                    {
                        inputID.removeClass('balid');
                        messageID.removeClass('balid-feedback');

                        inputID.addClass('inbalid');
                        messageID.addClass('inbalid-feedback');
                        messageID.html("Invalid file format. Accepted formats are: "+ minimumCharFileRemoveSquare);

                        flag = false;
                    }else{
                        inputID.removeClass('inbalid');
                        messageID.removeClass('inbalid-feedback');


                        inputID.addClass('balid');
                        messageID.addClass('balid-feedback');
                        let filesUploaded = [];
                        filesUploaded.push(inputID.val().match(
                            /[\/\\]([\w\d\s\.\-\(\)]+)$/
                        )[1]);
                        displaySuccessText.push(selection.files[i].name);


                        count ++;
                        flag = true;
                    }
                }

                if ((count == selection.files.length))
                {
                    displaySuccessText =  JSON.stringify(displaySuccessText);
                    displaySuccessText = displaySuccessText.replace("[","").replace("]","").toString();
                    messageID.html();
                    messageID.html(displaySuccessText);
                }else{
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');
                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                }
                if (selection.files.length < 1)
                {
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');

                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                    messageID.html("Please fill out this field.");

                    flag = false;
                }
            }
        }

        if (validationList[vlad].includes('multiFileSize'))
        {
            if(flag)
            {
                let nameofFile = inputID.attr('name');
                let file = $("input[name="+nameofFile+"]").get(0).files;

                let fileSize = validationList[vlad].split(":");
                let FileSizeRemoveSquares = fileSize[1].replace("[","").replace("]","").split(',').toString();
                let selection = document.getElementById(inputID_);
                let count = 0;
                let displaySuccessText =[];

                for (let i=0; i<selection.files.length; i++)
                {

                    if(selection.files[i].size > parseInt(FileSizeRemoveSquares*1000000))
                    {
                        inputID.removeClass('balid');
                        messageID.removeClass('balid-feedback');

                        inputID.addClass('inbalid');
                        messageID.addClass('inbalid-feedback');
                        messageID.html("Please upload file less than: "+ FileSizeRemoveSquares.toString() + "MB" );
                        flag = false;
                    }else{
                        inputID.removeClass('inbalid');
                        messageID.removeClass('inbalid-feedback');


                        inputID.addClass('balid');
                        messageID.addClass('balid-feedback');
                        let filesUploaded = [];
                        filesUploaded.push(inputID.val().match(
                            /[\/\\]([\w\d\s\.\-\(\)]+)$/
                        )[1]);
                        displaySuccessText.push(selection.files[i].name);


                        count ++;
                        flag = true;
                    }

                }
                if ((count == selection.files.length))
                {
                    displaySuccessText =  JSON.stringify(displaySuccessText);
                    displaySuccessText = displaySuccessText.replace("[","").replace("]","").toString();
                    messageID.html();
                    messageID.html(displaySuccessText);
                }else{
                    inputID.removeClass('balid');
                    messageID.removeClass('balid-feedback');
                    inputID.addClass('inbalid');
                    messageID.addClass('inbalid-feedback');
                }
            }

        }
        // \\Multiple file
    }
    return flag.toString();
}
