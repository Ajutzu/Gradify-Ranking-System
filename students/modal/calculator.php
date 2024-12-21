<!-- Grade Input Modal -->
<div class="modal fade" id="gradeInputModal" aria-labelledby="gradeModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <!-- Add header section -->
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="gradeModalLabel">GPA Calculator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 py-3">
                <form id="gradeForm" method="POST" action="save_grades.php">
                    <div class="scrollable-grades" style="max-height: 40vh; overflow-y: auto;">
                        <?php
                        // Get student ID from URL
                        $student_id =  $_GET['id'];

                        // Hidden input for student ID
                        echo '<input type="hidden" name="student_id" value="' . $student_id . '">';

                        // Query to get all subjects
                        $query = "SELECT * FROM subjects_table";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        // Loop through each subject
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="mb-4">';
                            echo '<label for="grade_' . $row['subject_code'] . '" class="form-label text-secondary small">' 
                                 . $row['subject_name'] . '</label>';
                            echo '<input type="number" class="form-control shadow-sm" placeholder="Enter grade" id="grade_' . $row['subject_code'] . '" 
                                  name="grades[' . $row['subject_code'] . ']" min="0" max="100" 
                                  step="0.01" required>';
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn brand-btn px-4">
                            Calculate GPA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>