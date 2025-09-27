fetch('blog-posts.json')
 .then(response => response.json())
 .then(data => {
    const blogPosts = data.posts;
    const blogPostsHTML = '';

    blogPosts.forEach(post => {
      blogPostsHTML += `
        <article>
          <h3>${post.title}</h3>
          <p>${post.summary}</p>
          <a href="#">Read More</a>
        </article>
      `;
    });

    document.getElementById('blog-posts').innerHTML = blogPostsHTML;
  });

document.addEventListener('DOMContentLoaded', () => {
  const submissionForm = document.getElementById('submission-form');

  submissionForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(submissionForm);
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ubmit-post.php', true);
    xhr.send(formData);

    xhr.onload = () => {
      if (xhr.status === 200) {
        console.log('Post submitted successfully!');
      } else {
        console.error('Error submitting post:', xhr.statusText);
      }
    };
  });
});