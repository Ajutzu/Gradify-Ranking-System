<!-- Join Classroom Modal -->
<div class="modal fade shadow" id="joinClassroomModal"
    aria-hidden="true" tabindex="-1"
    aria-labelledby="joinClassroomModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-body p-4">
                <form>
                    <!-- Header -->
                    <h4 class="modal-title mb-4" id="joinClassroomModalLabel">Join class</h4>

                    <!-- Current User Info -->
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="<?php echo '../' . $_SESSION['profile_picture'] ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                        <div>
                            <p class="mb-0"><?php echo $_SESSION['fullname'] ?></p>
                            <small class="text-muted"><?php echo $_SESSION['email'] ?></small>
                        </div>
                    </div>

                    <!-- Class Code Input -->
                    <div class="mb-4">
                        <label for="classCode" class="form-label">Class code</label>
                        <input type="text"
                            class="form-control"
                            id="classCode"
                            placeholder="Enter class code"
                            maxlength="7">
                        <small class="text-muted">Ask your teacher for the class code, then enter it here.</small>
                    </div>

                    <!-- Instructions -->
                    <div class="mb-4">
                        <p class="mb-2 fw-medium">To sign in with a class code</p>
                        <ul class="text-muted ps-3">
                            <li>Use an authorized account</li>
                            <li>Use a class code with 5-7 letters or numbers, and no spaces or symbols</li>
                        </ul>
                    </div>

                    <!-- Help Link -->
                    <div class="mb-4">
                        <small class="text-muted">
                            If you have trouble joining the class, go to the
                            <a href="#" class="text-decoration-none">Help Center article</a>
                        </small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn">Join</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>