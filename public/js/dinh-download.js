const { createRoot } = ReactDOM;
const { useReducer, useMemo, useState, useEffect } = React;
const dom = createRoot(document.getElementById('app'));

dom.render(<App />);

// REDUCER
const initialState = {
  submit: false,
  needtodo: 0,
  current: 0,
  perpage: 5,
  total: 100,
}

function reducer(state, { type, payload }) {
  switch (type) {
    case 'update_submit':
      return { ...state, submit: payload.submit };
    case 'update_need_to_do':
      return { ...state, needtodo: payload.needtodo };
    case 'update_current':
      return { ...state, current: payload.current };
    case 'update_perpage':
      return { ...state, perpage: payload.perpage };
    case 'update_total':
      return { ...state, total: payload.total };
    default:
      return { ...state };
  }
}

// APP
function App() {
  const [state, dispatch] = useReducer(reducer, initialState);
  // SIDE EFFECT
  useEffect(() => { getNeedtoDo() }, []);

  useEffect(() => {
    if (state.submit && state.current < state.total) {
      handleDownloadSheet();
    }
  }, [state.submit, state.current])

  // METHODS
  const getNeedtoDo = async () => {
    try {
      const params = {
        method: 'GET',
      }
      const response = await fetch('dinh-download/get-need-to-do', params);
      const { total } = await response.json();

      dispatch({
        type: 'update_need_to_do',
        payload: { needtodo: total },
      });
    } catch(e) {
      console.log(e);
      return 0;
    }
  }

  const onSubmit = () => {
    const { perpage, total } = state;

    if (perpage === 0 || total === 0) return;

    handleDownloadSheet();
  }

  const handleDownloadSheet = async () => {
    const { perpage, current, total } = state;

    try {
      const newPerpage = total - current > perpage ? perpage : total - current;
      const params = {
        method: 'POST',
        body: JSON.stringify({ perpage: newPerpage }),
      }
      const response = await fetch('dinh-download/handle-sheet', params);
      const { success } = await response.json();

      dispatch({
        type: 'update_current',
        payload: { current: current + success },
      });
      dispatch({
        type: 'update_submit',
        payload: { submit: true },
      });
      dispatch({
        type: 'update_perpage',
        payload: { perpage: newPerpage },
      });
    } catch(e) { console.log(e) }
  }

  // RENDER
  return (
    <div className="container py-5">
      <div className="row">
        <div className="col-lg-6">
          <p className="mb-3 text-success fw-bold text-center">The number of sheet need to do: {state.needtodo}</p>
          <Form
            perpage={state.perpage}
            total={state.total}
            dispatch={dispatch}
            onSubmit={onSubmit}
          />
        </div>
        <div className="col-lg-6">
          <Progress
            perpage={state.perpage}
            total={state.total}
            current={state.current}
          />
        </div>
      </div>
    </div>
  )
}

// FORM
function Form({ perpage, total, dispatch, onSubmit }) {
  // RENDER
  return (
    <form onSubmit={(e) => { e.preventDefault(); onSubmit(); }}>
      <div className="mb-3">
        <label htmlFor="numberPerPage" className="form-label">Number per page</label>
        <input
          type="number"
          className="form-control"
          id="numberPerPage"
          placeholder="number"
          value={perpage}
          onChange={(e) => dispatch({ type: 'update_perpage', payload: { perpage: +e.target.value } })}
        />
      </div>
      <div className="mb-3">
        <label htmlFor="numberPerPage" className="form-label">Number total</label>
        <input
          type="number"
          className="form-control"
          id="numberPerPage"
          placeholder="number"
          value={total}
          onChange={(e) => dispatch({ type: 'update_total', payload: { total: +e.target.value } })}
        />
      </div>
      <div className="mb-3 text-end">
        <button type="submit" className="btn btn-success">Submit</button>
      </div>
    </form>
  );
}

// PROGRESS
function Progress({ perpage, total, current }) {
  const percent = useMemo(() => (current / total) * 100, [current, total]);

  return (
    <div className="mb-3">
      <div className="d-flex justify-content-between mb-2">
        <div className="text-estate">perpage: {perpage}</div>
        <div className="text-end">{current}/{total}</div>
      </div>
      <div className="progress">
        <div className="progress-bar" role="progressbar" aria-label="Basic example" style={{width: `${percent}%`}} aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
  )
}