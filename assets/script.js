// Admin Delete confirmation
const deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(button => 
{
    button.addEventListener('click', function(event) 
    {
        if (!confirm("Are you sure you want to delete this package?"))
        {
            event.preventDefault();
        }
    });
});
