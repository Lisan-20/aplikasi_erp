# Best Practices: React 18 & Inertia.js

The frontend of this application is powered by React and Inertia.js. Inertia allows us to build a single-page application (SPA) without the complexity of a separate API layer.

## 1. Navigation using Inertia
- **DO**: Use Inertia's `<Link>` component to maintain the SPA feel.
  ```jsx
  // DO
  import { Link } from '@inertiajs/react';
  
  export default function Navigation() {
      return <Link href="/dashboard">Go to Dashboard</Link>;
  }
  ```
- **DON'T**: Use standard `<a>` tags, as they will cause a full browser page reload, losing state and feeling sluggish.
  ```jsx
  // DON'T
  export default function Navigation() {
      return <a href="/dashboard">Go to Dashboard</a>;
  }
  ```

## 2. Programmatic Navigation
- **DO**: Use `router.visit()`, `router.post()`, etc., for programmatic redirects instead of standard window assignments.
  ```jsx
  // DO
  import { router } from '@inertiajs/react';
  const saveAndRedirect = () => {
      router.post('/save', data, { onSuccess: () => router.visit('/dashboard') });
  }
  ```
- **DON'T**: Use `window.location.href`.
  ```jsx
  // DON'T
  const saveAndRedirect = () => {
      window.location.href = '/dashboard'; // Causes full page reload
  }
  ```

## 3. Form Handling
- **DO**: Use Inertia's `useForm` hook for forms. It automatically maps server-side validation errors and tracks loading state.
  ```jsx
  // DO
  import { useForm } from '@inertiajs/react';

  export default function Login() {
      const { data, setData, post, processing, errors } = useForm({ email: '' });

      const submit = (e) => {
          e.preventDefault();
          post('/login');
      };

      return (
          <form onSubmit={submit}>
              <input value={data.email} onChange={e => setData('email', e.target.value)} />
              {errors.email && <span>{errors.email}</span>}
              <button disabled={processing}>Submit</button>
          </form>
      );
  }
  ```
- **DON'T**: Use manual `fetch` or `axios` calls with standard `useState` to handle forms unless dealing with external APIs outside Laravel.
  ```jsx
  // DON'T
  const [email, setEmail] = useState('');
  const [loading, setLoading] = useState(false);
  
  const submit = async () => {
      setLoading(true);
      await axios.post('/login', { email });
      // manually handle errors and resets...
  }
  ```

## 4. Component Architecture
- **DO**: Use React Functional Components and Hooks. Extract logic into Custom Hooks.
  ```jsx
  // DO
  export default function UserProfile({ user }) {
      const isMobile = useMediaQuery('(max-width: 768px)'); // Custom hook
      return <div>{user.name} - {isMobile ? 'Mobile' : 'Desktop'}</div>;
  }
  ```
- **DON'T**: Use Class-based Components. They are outdated and unsupported by most modern hook-based libraries like Inertia.
  ```jsx
  // DON'T
  class UserProfile extends React.Component {
      render() { return <div>{this.props.user.name}</div>; }
  }
  ```

## 5. State Management & Performance
- **DO**: Rely on Inertia's Page Props (`usePage().props`) for global server-provided state (like the authenticated user). Use `useMemo` for expensive client-side calculations.
  ```jsx
  // DO
  import { usePage } from '@inertiajs/react';
  import { useMemo } from 'react';
  
  export default function Dashboard({ largeDataset }) {
      const { auth } = usePage().props;
      const sortedData = useMemo(() => largeDataset.sort(), [largeDataset]);
      return <div>Welcome, {auth.user.name}</div>;
  }
  ```
- **DON'T**: Introduce Redux or Zustand just to store data you get directly from the Laravel backend. Do not perform expensive sorts/filters directly in the render cycle without `useMemo`.

## 6. Security (XSS Prevention)
- **DO**: Rely on React's automatic string escaping. If you MUST render raw HTML, sanitize it first (e.g., using DOMPurify).
  ```jsx
  // DO
  import DOMPurify from 'dompurify';
  export default function Post({ content }) {
      return <div dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(content) }} />;
  }
  ```
- **DON'T**: Blindly trust database HTML content and inject it.
  ```jsx
  // DON'T
  export default function Post({ content }) {
      return <div dangerouslySetInnerHTML={{ __html: content }} />; // XSS Vulnerability
  }
  ```
