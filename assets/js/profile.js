function updateProfile() {
    console.log('update profile');
  
    var name = $('#name').val();
    var age = $('#age').val();
    var dob = $('#dob').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var profession = $('#profession').val();
    var company = $('#company').val();
  
    const connectionString = "mongodb+srv://firdaus:firdaus1234@cluster0.ocpexo6.mongodb.net";
    const collectionName = "profiles";
  
    const profileUpdate = {
      name,
      age,dob,
      mobile,
      email,
      address,
      profession,
      company
    };
  
    $.ajax({
      url: connectionString + "/" + collectionName,
      type: "PUT", // Change the type to PUT for updating an existing document
      data: profileUpdate,
    //   dataType: "json",
      headers: {
        "Content-Type": "application/json",
      },
      success: function(data) {
        console.log("Profile updated successfully");
      },
      error: function(error) {
        console.error('Error updating profile:', error);
      },
    });
  }