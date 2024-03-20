export interface AlertMessageInterface
{
  type?: 'alert-primary' | 'alert-secondary' | 'alert-success' | 'alert-danger' | 'alert-warning';
  title?: string
  message: string
  open?: boolean
}
