function Footer() {
  return (
    <footer
      style={{ height: '10vh' }}
      className="bg-dark text-white d-flex justify-content-between align-items-center px-3 "
    >
      <div>&copy; 2025 David Incarbone.</div>

      <ul className="d-flex gap-3 mb-0">
        <li>
          <i className="fa-brands fa-twitter"></i>
        </li>
        <li>
          <i className="fa-brands fa-instagram"></i>
        </li>
        <li>
          <i className="fa-brands fa-tiktok"></i>
        </li>
        <li>
          <i className="fa-brands fa-github"></i>
        </li>
        <li>
          <i className="fa-brands fa-reddit"></i>
        </li>
        <li></li>
      </ul>
    </footer>
  );
}

export default Footer;
