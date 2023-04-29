const groupBy = (
    inputArray,
    key,
    removeKey = false,
    outputType = {},
  ) => {
    return inputArray.reduce(
      (previous, current) => {
        // Get the current value that matches the input key and remove the key value for it.
        const {
          [key]: keyValue
        } = current;
        // remove the key if option is set
        removeKey && keyValue && delete current[key];
        // If there is already an array for the user provided key use it else default to an empty array.
        const {
          [keyValue]: reducedValue = []
        } = previous;
  
        // Create a new object and return that merges the previous with the current object
        return Object.assign(previous, {
          [keyValue]: reducedValue.concat(current)
        });
      },
      // Replace the object here to an array to change output object to an array
      outputType,
    );
  };

const participantsAndScore = (participant: any, score: any) => {
    const scores = groupBy(score, 'participant_id', true);
    let arr = [];
    for (let i = 0; i < participant.length; i++) {
        let participant_id = participant[i].id;
        for (let a = 0; a <= Object.keys(scores).length; a++) {
            // let score_id = scores[a];
            scores[a]
            if (participant_id === a) {
                arr.push({
                    ...participant[i],
                    percent_score: scores[a],
                });
            }
        }
    }
    return arr;
};

export default {
  participantsAndScore
}

