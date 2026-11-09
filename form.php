
<form method="post" action="">

    <label for="student_name">Student Name:</label>
    <input type="text" id="student_name" name="student_name"
        value="<?php echo htmlspecialchars($Student_name ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <label for="matric_number">Matric Number:</label>
    <input type="text" id="matric_number" name="matric_number"
        value="<?php echo htmlspecialchars($Matric_no ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <label for="subject_name">Subject:</label>
    <input type="text" id="subject_name" name="subject_name"
        value="<?php echo htmlspecialchars($Subject_name ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <label for="subject_code">Subject Code:</label>
    <input type="text" id="subject_code" name="subject_code"
        value="<?php echo htmlspecialchars($Subject_code ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <label for="test_1">Test 1 (20%):</label>
    <input type="number" id="test_1" name="test_1"
        min="0" max="20" step="0.01"
        value="<?php echo htmlspecialchars($Test_1 ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <label for="test_2">Test 2 (30%):</label>
    <input type="number" id="test_2" name="test_2"
        min="0" max="30" step="0.01"
        value="<?php echo htmlspecialchars($Test_2 ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <label for="final_examination">Final Exam (50%):</label>
    <input type="number" id="final_examination" name="final_examination"
        min="0" max="50" step="0.01"
        value="<?php echo htmlspecialchars($Final_examination ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required>
    <br><br>

    <input type="submit" name="submit" value="Submit">

</form>
